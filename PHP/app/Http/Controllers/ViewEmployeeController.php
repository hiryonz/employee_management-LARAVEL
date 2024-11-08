<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DescuentoFalta;
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

        date_default_timezone_set('America/Panama');
        $fechaActual = date("Y/m/d");


        $employeeData = Employee::select('cedula', 'nombre', 'apellido', 'genero', 'departamento', 'tipo')->get()->toArray();
        $planillaData = Planilla::select('cedula', 'descuentos', 'salario_bruto', 'salario_neto')->get()->toArray();
        //$entradaSalidaData = EntradaSalida::select( 'cedula', 'hora_entrada', 'hora_salida')->get()->toArray();
        $descuentoFalta = DescuentoFalta::select('cedula', 'horas_faltas', 'descuentos_faltas')
        ->where('fecha', $fechaActual)->get()->toArray();

        $groupData = [];

        foreach($employeeData as  $employee) {
            $groupData[$employee['cedula']]['employee'] = $employee;
        }

        foreach($descuentoFalta as  $descuento) {
            $groupData[$descuento['cedula']]['descuento'] = $descuento;
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
            
            $data['neto'] = ['salario neto' => ($data['planilla']['salario_neto'] ?? 0) - ($data['descuento']['descuentos_faltas'] ?? 0)];
            unset($data['planilla']['salario_neto']);

            $employee[] = array_merge(
                $data['employee'] ?? ['cedula' => $cedula, 'nombre' => 'N/A', 'apellido' => 'N/A'],
                $data['descuento'] ?? ['horas_faltas' => 'N/A', 'descuentos_faltas' => 'N/A'],
                $data['planilla'] ?? ['salario_bruto' => 'N/A', 'descuento' => 'N/A'],
                $data['neto'] ?? ['salario_neto' => 'N/A'],
            );
        }
        //dd($employee);

        return view("viewEmployee", compact("employee"));
    }
}
