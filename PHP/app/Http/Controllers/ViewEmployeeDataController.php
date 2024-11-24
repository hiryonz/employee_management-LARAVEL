<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Middleware\VerifyAdmin;
use App\Models\DescuentoFalta;
use App\Models\Direction;
use App\Models\Employee;
use App\Models\Login_user;
use App\Models\Planilla;
use App\Models\QrCode_user;
use App\Models\Task;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Psy\CodeCleaner\LabelContextPass;
use App\Helper\Helpers;

class ViewEmployeeDataController extends Controller
{

    public function index($id) {
        
        $year = date("Y");
        $month = date("m");

        $smallEmployeeData = Employee::select('cedula', 'nombre')->get()->toArray();

        $employeeData = Employee::where('cedula', $id)->first();

        $direcionData = Direction::where('cedula', $id)->first();
        
        $planillaData = Planilla::where('cedula', $id)->first();

        $descuentoFalta = DescuentoFalta::select('fecha', 'horas_faltas', 'Descuentos_faltas', 'Horas_extras'
        )->where('cedula', $id)->get()->toArray();

        $faltas = DescuentoFalta::select(DB::raw('SUM(horas_faltas) as horas, SUM(Descuentos_faltas) as descuento'))->first();

        $userData = Login_user::where('cedula', $id)->first();

        //dd($userData);
        $QR = QrCode_user::select('qr_code')
        ->where('cedula', $id)
        ->first();
        
        $mesFalta = DescuentoFalta::getDescuentoFaltaMensual($id, $year);
        $semanaFalta = DescuentoFalta::getDescuentoFaltaSemanal($id);
        $labelsTask = ['asignado', 'trabajando'];

        $task = Task::select('estado')
        ->whereIn('estado', $labelsTask)
        ->where('cedula', $id)->get()->toArray() ?? [];

        $labelsTask2 = ['nuevo', 'asignado', 'trabajando', 'revisar'];

        $task2 = Task::select('estado')
        ->whereIn('estado', $labelsTask2)
        ->where('cedula', $id)->get()->toArray() ?? [];
        
        $data = compact('smallEmployeeData', 'employeeData', 'direcionData',  
        'planillaData', 'userData', 'QR', 'descuentoFalta', 'faltas', 'mesFalta', 'semanaFalta',
        'labelsTask', 'task', 'labelsTask2', 'task2');

        return view('viewEmployeeData',  $data);


    }

    public function destroy($id) {
        try {
            $employee = Employee::findOrFail($id);
            $employee->delete();

            return redirect(route("viewEmployee"))->with("success",  "Se logro eliminar correctament el empleado con cedula: " . $id);
        } catch (\Exception $e) {
            return redirect()->back()->with("error",  "Error al intentar eliminar el empelado con cedula " . $id .' ' . $e->getMessage());
        }
    }
    

        

    public function update(Request $request) {
        $request -> validate([
            "cedula" => "required|string",
            "nombre" => "required|string",
            "apellido" => "required|string",
            "genero" => "required|string",
            "edad" => "required|integer",
            "nacimiento" => "required|date",
            "correo"  => "required|email",
            "telefono" => "required|string",
            "tipo" => "required|string",
            "departamento" =>  "required|string",
            "turno" =>  "required|integer",
            'user' => 'required|string|unique:login_user,user,' . $request->cedula . ',cedula',
            "ciudad" => "required|string",
            "codigo_postal" => "required|string",
            "provincia" => "required|string",
            "corregimiento" => "required|string",
            "distrito" =>  "required|string",
            "numero_casa" => "required|string",
            "descripcion" => "required|string",
            "hora_trabajada"  => "required|numeric",
            "sal_hora" => "required|numeric",
            "descuento" => "required|numeric",
            "seguro_social" => "required|numeric",
            "seguro_educativo" => "required|numeric",
            "ir" => "required|numeric",
            "deducciones" => "required|numeric",
            "salario_bruto" => "required|numeric",
            "salario_neto" => "required|numeric "
        ]);

        DB::beginTransaction();

        try {
            Employee::where('cedula', $request -> cedula)->update([
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'genero' => $request->genero,
                'edad' => $request->edad,
                'nacimiento' => $request->nacimiento,
                'email'  => $request->correo,
                'telefono' => $request->telefono,
                'tipo' => $request->tipo,
                'departamento' => $request->departamento,
                'id_turno' => $request->turno,
            ]);
    
            Direction::where('cedula', $request->cedula)->update([
                'provincia' => $request->provincia,
                'ciudad' => $request->ciudad,
                'codigo_postal' => $request->codigo_postal,
                'corregimiento' => $request->corregimiento,
                'distrito' => $request->distrito,
                'numero_casa' => $request->numero_casa,
                'descripcion' => $request->descripcion,
            ]);
    
            Planilla::where('cedula', $request->cedula)->update([
                'salario_h' => $request->sal_hora,
                'hora_trabajada' => $request->hora_trabajada,
                'descuentos' => $request->descuento,
                'seguro_social' => $request->seguro_social,
                'seguro_educativo' => $request->seguro_educativo,
                'impuesto_renta' => $request->ir,
                'salario_bruto' => $request->salario_bruto,
                'salario_neto' => $request->salario_neto,
            ]);
    
            Login_user::where('cedula', $request -> cedula)->update([
                'user' => $request->user
            ]);
    
            DB::commit();
            return redirect()->back()->with("success",  "Se actualizo correctamente el empleado" . $request->cedula);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with("error",  "Error al registrar el empleado" . $e->getMessage());
        }
    }


public function updateImg(Request $request, $id) {


    // Obtener el empleado a partir de su cedula (ID)
    $employee = Employee::where('cedula', $id)->firstOrFail();
    if ($request->hasFile('profile_image')) {
        if (File::exists($employee->profile_image)) {
            File::delete($employee->profile_image); // Elimina el archivo
            // También puedes usar unlink($filePath) si no quieres usar File
            echo "Archivo eliminado correctamente.";
        } else {
            echo "El archivo no existe.";
        }
        $image = $request->file('profile_image');
        $mimeType = $image->getMimeType();

        // Crear un nombre único para la imagen
        $imageName = $employee->cedula . '.' . time();
        $path = 'img/userProfile/';
        $subir = $request->file('profile_image')->move($path, $imageName);

        // Actualizar el registro en la base de datos con la nueva ruta de la imagen
       
       $newImg = $path . $imageName;
       
        $employee->profile_image = $newImg;
        $employee->image_mime = $mimeType;
        //dd($employee->profile_image);
    }

    // Guardar los cambios en la base de datos
    $employee->save();

    return redirect()->back()->with('success', 'Imagen de perfil actualizada correctamente.');
}




}
