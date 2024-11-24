<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\InchargeTask;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function  index() {

        $user = Auth::user();
        
        if($user->employee->tipo === 'admin') {
            return $this -> getAdminDataTask();
        }else {
            return $this -> getEmployeeDataTask($user->employee->departamento);
        }

    }
    
    
    public function getAdminDataTAsk() {
        $dataTask = Task::with([
            'employee:cedula,nombre,departamento', // Relación con Employee
            'incharge:id,id_incharge,cedula', // Relación con InchargeTask
        ])->get()->toArray();
        
        $employeeData = Employee::select( 'cedula', 'nombre', 'departamento', 'profile_image')->get()->toArray();
        //dd($dataTask);
        return view('task', compact('dataTask', 'employeeData'));
    }

    public function getEmployeeDataTask($departamento) {
        $dataTask = Task::with([
            'employee:cedula,nombre,departamento', // Relación con Employee
            'incharge:id,id_incharge,cedula', // Relación con InchargeTask
        ])
        ->where('departamento', $departamento)->get()->toArray();
        $employeeData = Employee::select( 'cedula', 'nombre', 'departamento', 'profile_image')->get()->toArray();

        return view('task', compact('dataTask','employeeData'));

    }

    public function create(Request $request) {
        try {
            $request->validate([
                'cedula' => 'required',
                'descripcion' => 'required|string',
                'titulo' => 'required|string',
                'departamento' => 'required|string',
                'prioridad' => 'required|string',
                'fecha_creacion' => 'required|date',
                'fecha_limite' => 'required|date|after_or_equal:today',
                'forEmployee' => 'array', // Validar que sea un arreglo
                'forEmployee.*' => 'string|exists:employee,cedula', // Validar cada elemento
            ]);
            
            $task = Task::insertTask($request);
            //dd($request->forEmployee);
    
                // Procesar los encargados (forEmployee[])
            if ($request->has('forEmployee')) {
                foreach ($request->forEmployee as $cedula) {
                    InchargeTask::insertInchargeTask($cedula, $task->id);
                }
            }
    
            return redirect()->back()
            ->with("success", "Tarea agregada correctamente."); 

        }catch (\Exception $e) {
            // Manejar errores
            \Log::error('Error al eliminar la tarea: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());

            return redirect()->back()->with(['message' => 'error al eliminar.' . $e->getMessage()]);
        }
    }

    public function updateState(Request $request) {
        try {
            // Validar los datos recibidos
            $request->validate([
                'id' => 'required|integer|exists:task,id',
                'estado' => 'required|string'
            ]);
    
            // Encontrar la tarea por ID
            $task = Task::findOrFail($request->id);
            
            // Actualizar el estado
            $task->estado = $request->estado;
            $task->save();
    
            // Responder con éxito
            return response()->json([
                'success' => true,
                'message' => 'Estado de la tarea actualizado correctamente.'
            ]);
        } catch (\Exception $e) {
            // Manejar errores
            \Log::error('Error en updateStatus: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request)
    {
        //  dd($request->all());

        try {
            // Validar los datos recibidos
            $request->validate([
                'id' => 'required|integer|exists:task,id',
                'titulo' => 'required|string|max:255',
                'descripcion' => 'required|string',
                'departamento' => 'required|string',
                'prioridad' => 'required|string|in:alta,media,baja',
                'estado' => 'required|string',
                'fecha_limite' => 'nullable|date|after_or_equal:today',
                'forEmployee' => 'nullable|array',
                'forEmployee.*' => 'string|exists:employee,cedula'
            ]);

            // Encontrar la tarea por ID
            $task = Task::findOrFail($request->id);
            
            // Actualizar los campos de la tarea
            $task->titulo = $request->titulo;
            $task->descripcion = $request->descripcion;
            $task->departamento = $request->departamento;
            $task->prioridad = $request->prioridad;
            $task->estado = $request->estado;
            $task->fecha_limite = $request->fecha_limite;
            $task->save();

                    // Obtener los IDs de los empleados actualmente asignados
            $currentEmployeeIds = InchargeTask::where('id_incharge', $task->id)->pluck('cedula')->toArray();

            // Obtener las cédulas de los empleados desde la solicitud y convertirlas a IDs
            $requestedEmployeeCedulas = $request->input('forEmployee', []);
            $requestedEmployeeIds = Employee::whereIn('cedula', $requestedEmployeeCedulas)->pluck('cedula')->toArray();

            // Crear arrays asociativos para facilitar la verificación
            $currentEmployeeIdsAssoc = array_flip($currentEmployeeIds);
            $requestedEmployeeIdsAssoc = array_flip($requestedEmployeeIds);
            
            // Agregar nuevos empleados asignados
            foreach ($requestedEmployeeIds as $employeeId) {
                if (!isset($currentEmployeeIdsAssoc[$employeeId])) {
                    // Crear nueva asignación
                    InchargeTask::create([
                        'id_incharge' => $task->id,
                        'cedula' => $employeeId,
                    ]);
                }
            }
            
            // Eliminar empleados que ya no están asignados
            foreach ($currentEmployeeIds as $employeeId) {
                //dd(!isset($requestedEmployeeIdsAssoc[$employeeId]));
                if (!isset($requestedEmployeeIdsAssoc[$employeeId])) {
                    // Eliminar la asignación
                    InchargeTask::where('id_incharge', $task->id)
                        ->where('cedula', $employeeId)
                        ->delete();
                }
            }

    
            // Responder con éxito
            return response()->json([
                'success' => true,
                'message' => 'Tarea actualizada correctamente.',
            ]);
        } catch (\Exception $e) {
            // Manejar errores
            \Log::error('Error en updateTask: ' . $e->getMessage());
    
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }


    public function destroy(Request $request)
    {
        try {
            // Validar los datos recibidos
            $request->validate([
                'deleteId' => 'required|exists:task,id',
            ]);

            // Encontrar la tarea por ID
            $task = Task::findOrFail($request->deleteId);


            // Eliminar la tarea
            $task->delete();

            // Responder con éxito
            return redirect()->back()->with(['message' => 'Tarea eliminada correctamente.']);
        } catch (\Exception $e) {
            // Manejar errores
            \Log::error('Error al eliminar la tarea: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());

            return redirect()->back()->with(['message' => 'error al eliminar.' . $e->getMessage()]);

        }
    }

    


}
