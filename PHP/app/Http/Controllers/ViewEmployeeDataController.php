<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Direction;
use App\Models\Employee;
use App\Models\Login_user;
use App\Models\Planilla;

class ViewEmployeeDataController extends Controller
{

    public function index($id) {
        
        $smallEmployeeData = Employee::select('cedula', 'nombre')->get()->toArray();

        $employeeData = Employee::select(
            'cedula', 
            'nombre', 
            'apellido', 
            'genero', 
            'edad', 
            'nacimiento', 
            'email',
            'telefono',
            'tipo', 
            'departamento',
            'id_turno')
            ->where('cedula', $id)->get()->toArray() ?? [];

        $direcionData = Direction::select(
            'cedula',
            'provincia',
            'corregimiento',
            'distrito',
            'ciudad',
            'codigo_postal',
            'numero_casa',
            'descripcion')
            ->where('cedula', $id)->get()->toArray() ?? [];
        
        $planillaData = Planilla::select(
            'cedula',
            'hora_trabajada',
            'salario_h',
            'descuentos',
            'salario_bruto',
            'salario_neto',
            'seguro_social',
            'seguro_educativo',
            'impuesto_renta',
        )->where('cedula', $id)->get()->toArray() ?? [];


        $userData = Login_user::select(
            'cedula',
            'user'
        )
        ->where('cedula', $id)->get()->toArray() ??  [];

        


        //dd($allEmployeeData);
        return view('viewEmployeeData',  compact('smallEmployeeData', 'employeeData', 'direcionData',  'planillaData', 'userData'));


    }

}
