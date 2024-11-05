<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Direction;
use App\Models\Employee;
use App\Models\EntradaSalida;
use App\Models\Planilla;
use App\Models\Task;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {


        /*
        *
        *   MUY IMPORTANTE EL toArray()
        *   permite utilizar los datos de forma mas secilla:  $data['name']
        *
        */
        $fechaActual = date("Y/m/d");

        $employeeData = Employee::select('cedula', 'nombre', 'apellido')->get()->toArray() ?? [];
        $entradaSalidaData = EntradaSalida::select('cedula', 'hora_entrada', 'hora_salida')
        ->where('fecha', $fechaActual)->get()->toArray() ?? [];
        $taskData = Task::select('id', 'cedula', 'descripcion', 'prioridad', 'fecha_creacion', 'fecha_limite')->get()->toArray() ?? []; 


        // Agrupar datos por cédula
        $groupedData = [];

        // Agrupa empleados
        foreach ($employeeData as $employee) {
            $groupedData[$employee['cedula']]['employee'] = $employee;
        }

        /*
        // Agrupa direcciones
        foreach ($directionData as $direction) {
            $groupedData[$direction['cedula']]['direction'] = $direction;
        }

        // Agrupa planillas
        foreach ($planillaData as $planilla) {
            $groupedData[$planilla['cedula']]['planilla'] = $planilla;
        }
        */

        // Agrupa entrada y salida
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
                //$data['direction'] ?? ['provincia' => 'N/A', 'corregimiento' => 'N/A', 'ciudad' => 'N/A'],
                //$data['planilla'] ?? ['salario_neto' => 'N/A'],
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
        $countPersonal = EntradaSalida::whereNotNull('hora_entrada')->count()-1;


        return view('home', compact('employee', 'task', 'totalPersonal', 'countPersonal')) ;
    }


    public function obtenerReportes(Request $request) {
        
    }


}
