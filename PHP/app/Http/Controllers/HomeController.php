<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DescuentoFalta;
use App\Models\Direction;
use App\Models\Employee;
use App\Models\EntradaSalida;
use App\Models\News;
use App\Models\Planilla;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public function index()
    {


        
        date_default_timezone_set('America/Panama');
        $user = Auth::user();
        
        if($user->employee->tipo === 'admin') {
            return $this -> getAdminData();
        }else {
            return $this -> getEmployeeData($user->employee->cedula);
        }
        
        
    }
    
    
    public function getAdminData() {
        /*
        *
        *   MUY IMPORTANTE EL toArray()
        *   permite utilizar los datos de forma mas secilla:  $data['name']
        *
        */
        $fechaActual = date("Y/m/d");
        $year = date("Y");
        $month = date("m");

        $employeeData = Employee::select('cedula', 'nombre', 'apellido')->get()->toArray() ?? [];
        $entradaSalidaData = EntradaSalida::select('cedula', 'hora_entrada', 'hora_salida')
        ->where('fecha', $fechaActual)->get()->toArray() ?? [];
        $taskData = Task::select('id', 'cedula', 'descripcion', 'prioridad', 'fecha_creacion', 'fecha_limite')->get()->toArray() ?? []; 

        $descuentoFaltas = DescuentoFalta::select('cedula', DB::raw('SUM(horas_faltas) as total_falta'))
        ->whereYear('fecha', $year)
        ->whereMonth('fecha', $month)
        ->groupBy('cedula')
        ->get();

        $totalHorasFaltas = DescuentoFalta::whereYear('fecha', $year)
        ->whereMonth('fecha', $month)
        ->sum('horas_faltas');
        

        $labels = $descuentoFaltas->pluck('cedula')->toArray();
        $dataDescuento = $descuentoFaltas->pluck('total_falta')->toArray();
        

        // Agrupar datos por cédula
        $groupedData = [];

        foreach ($employeeData as $employee) {
            $groupedData[$employee['cedula']]['employee'] = $employee;
        }
        foreach ($entradaSalidaData as $entradaSalida) {
            $groupedData[$entradaSalida['cedula']]['entradaSalida'] = $entradaSalida;
        }


        /*
        *
        *   MUY IMPORTANTE EL array_merge()
        *   permite juntar muchos arrays y subarrays
        *
        */
        $employee = [];
        foreach ($groupedData as $cedula => $data) {
            $employee[] = array_merge(
                $data['employee'] ?? ['cedula' => $cedula, 'nombre' => 'N/A', 'apellido' => 'N/A'],
                $data['entradaSalida'] ?? ['hora_entrada' => 'N/A', 'hora_salida' => 'N/A']
            );
        }

        $task = [];
        for ($i = 0; $i < count($taskData); $i++) {
            $task[$i] = array_merge(
                $taskData[$i] ?? ['N/A']
            );
        }

        $totalPersonal =   count($employee);
        $countPersonal = EntradaSalida::whereNotNull('hora_entrada')->where('fecha', $fechaActual)->count();

        return view('home', compact('employee', 'task', 'totalPersonal', 'countPersonal', "labels", 'dataDescuento', 'totalHorasFaltas')) ;
    }

    public function getEmployeeData($id) {
        $year = date("Y");
        $month = date("m");
        $descuentoFaltas = DescuentoFalta::select(DB::raw('SUM(horas_faltas) as total_horas_faltas, SUM(descuentos_faltas) as total_descuento'))
        ->whereYear('fecha', $year)
        ->whereMonth('fecha', $month)
        ->where('cedula', $id)
        ->first();
        

        $mesFalta = DescuentoFalta::getDescuentoFaltaMensual($id, $year);
        $semanaFalta = DescuentoFalta::getDescuentoFaltaSemanal($id);

        


        //dd($report, $news);
        
        return view('homeEmployee', compact('mesFalta', 'semanaFalta', 'descuentoFaltas'));

    }


}
