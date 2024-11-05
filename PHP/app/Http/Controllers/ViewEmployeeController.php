<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Direction;
use App\Models\Employee;
use App\Models\EntradaSalida;
use App\Models\Planilla;
use App\Models\Task;
use Illuminate\Http\Request;

class ViewEmployeeController extends Controller
{
    public function index() {

        
        /*
        *
        *   MUY IMPORTANTE EL toArray()
        *   permite utilizar los datos de forma mas secilla:  $data['name']
        *
        */

        $employeeData = Employee::select('cedula', 'nombre', 'apellido', 'genero', 'email', 'departamento', 'tipo')->get()->toArray();
        $directionData = Direction::select('cedula', 'provincia')->get()->toArray();
        $planillaData = Planilla::select('cedula', 'descuentos_faltas', 'horas_faltas', 'salario_neto')->get()->toArray();
        //$entradaSalidaData = EntradaSalida::select( 'cedula', 'hora_entrada', 'hora_salida')->get()->toArray();


        $groupData = [];

        foreach($employeeData as  $employee) {
            $groupData[$employee['cedula']]['employee'] = $employee;
        }
        foreach($directionData as  $direction) {
            $groupData[$direction['cedula']]['direction'] = $direction;
        }
        foreach($planillaData as  $planilla) {
            $groupData[$planilla['cedula']]['planilla'] = $planilla;
        }
        
        /*foreach($entradaSalidaData as  $entradaSalida) {
            $groupData[$entradaSalida['cedula']]['entradaSalida'] = $entradaSalida;
        }
        */


        /*
        *
        *   MUY IMPORTANTE EL array_merge()
        *   permite juntar muchos arrays y subarrays
        *
        */

        $employee = [];
        foreach ($groupData as $cedula => $data) {
            $employee[] = array_merge(
                $data['employee'] ?? ['cedula' => $cedula, 'nombre' => 'N/A', 'apellido' => 'N/A'],
                $data['direction'] ?? ['provincia' => 'N/A'],
                $data['planilla'] ?? ['descuentos_faltas' => 'N/A', 'horas_faltas' => 'N/A', 'salario_neto' => 'N/A'],
                //$data['entradaSalida'] ?? ['hora_entrada' => 'N/A', 'hora_salida' => 'N/A']
            );
        }
        //dd($employee);

        return view("viewEmployee", compact("employee"));
    }
}
