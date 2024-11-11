<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Direction;
use App\Models\Employee;
use App\Models\Login_user;
use App\Models\Planilla;
use App\Models\QrCode_user;
use DB;
use Illuminate\Http\Request;

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
            ->where('cedula', $id)->first();

        $direcionData = Direction::select(
            'cedula',
            'provincia',
            'corregimiento',
            'distrito',
            'ciudad',
            'codigo_postal',
            'numero_casa',
            'descripcion')
            ->where('cedula', $id)->first();
        
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
        )->where('cedula', $id)->first();


        $userData = Login_user::select(
            'cedula',
            'user'
        )
        ->where('cedula', $id)->first();


        $QR = QrCode_user::select('qr_code')
        ->where('cedula', $id)
        ->first();
          
        

        return view('viewEmployeeData',  
        compact('smallEmployeeData', 'employeeData', 'direcionData',  'planillaData', 'userData', 'QR'));


    }

    public function destroy($id) {
        try {
            $employee = Employee::findOrFail($id);
            $employee->delete();

            return redirect(route("viewEmployee"))->with("success",  "Se logro eliminar correctament el empleado con cedula: " . $id);
        } catch (\Exception $e) {
            return redirect(route("viewEmployeeData", ['id' => $id]))->with("error",  "Error al intentar eliminar el empelado con cedula " . $id .' ' . $e->getMessage());
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
            return redirect(route("viewEmployeeData", ['id' => $request->cedula]))->with("success",  "Se actualizo correctamente el empleado" . $request->cedula);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect(route("viewEmployeeData", ['id' => $request->cedula]))->with("error",  "Error al registrar el empleado" . $e->getMessage());
        }



    }

}
