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

        $employeeData = Employee::where('cedula', $id)->first();

        $direcionData = Direction::where('cedula', $id)->first();
        
        $planillaData = Planilla::where('cedula', $id)->first();


        $userData = Login_user::where('cedula', $id)->first();


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
        $request->validate([
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $employee = Employee::where('cedula', $id)->firstOrFail();

        // Manejo de la imagen
        if ($request->hasFile('profile_image')) {
            // Obtener el contenido del archivo de imagen
            $image = $request->file('profile_image');
            $imageContent = file_get_contents($image->getRealPath());
            $imageBase64 = base64_encode($imageContent);

            // Obtener el tipo MIME de la imagen
            $mimeType = $image->getMimeType();

            // Guardar el contenido base64 y el tipo MIME en la base de datos
            $employee->profile_image = $imageBase64;
            $employee->image_mime = $mimeType;

        } else {
            // Si no se sube imagen, asignar una imagen predeterminada basada en la primera letra del nombre
            $firstLetter = strtoupper(substr($employee->nombre, 0, 1));
            $defaultImagePath = public_path('default_images/' . $firstLetter . '.png');

            // Verificar si la imagen existe, si no, asignar una imagen genérica
            if (!file_exists($defaultImagePath)) {
                $defaultImagePath = public_path('default_images/default.png');
            }

            // Obtener el contenido de la imagen predeterminada
            $imageContent = file_get_contents($defaultImagePath);
            $imageBase64 = base64_encode($imageContent);

            // Obtener el tipo MIME de la imagen predeterminada
            $mimeType = mime_content_type($defaultImagePath);

            // Guardar en la base de datos
            $employee->profile_image = $imageBase64;
            $employee->image_mime = $mimeType;
        }

        // Guardar los cambios
        $employee->save();

        return redirect()->back()->with('success', 'Imagen de perfil actualizada correctamente.');
    }

}
