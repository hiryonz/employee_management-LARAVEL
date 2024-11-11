<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Direction;
use App\Models\Employee;
use App\Models\Login_user;
use App\Models\Planilla;
use App\Models\QrCode_user;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Support\Str;


class addEmployeeController extends Controller
{
    
    public function index(Request $request) {
        return view("addEmployee");
    }

    public function  create(Request $request) {
        $request -> validate([
            "cedula" => "required|string|unique:employee,cedula",
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
            "user" => "required|string|unique:login_user,user",
            "password" => "required|string",
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
            
            $authcode = Str::random(10);
            $qrContent = json_encode(['cedula' => $request->cedula, 'authcode' => $authcode]);
            
            // Configura el renderizador de BaconQrCode con Imagick como backend
            $renderer = new ImageRenderer(
                new RendererStyle(200),
                new ImagickImageBackEnd()
            );
            $writer = new Writer($renderer);
            
            // Genera el código QR como una imagen usando Imagick
            $qrCodeImage = $writer->writeString($qrContent);
            
            // Codifica en base64 para almacenarlo en la base de datos
            $qrCodeBase64 = base64_encode($qrCodeImage);



            Employee::create([
                'cedula' => $request->cedula,
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
            
            Direction::create([
                'cedula' => $request->cedula,
                'ciudad' => $request->ciudad,
                'codigo_postal' => $request->codigo_postal,
                'provincia' => $request->provincia,
                'corregimiento' => $request->corregimiento,
                'distrito' => $request->distrito,
                'numero_casa' => $request->numero_casa,
                'descripcion' => $request->descripcion
            ]);
            
            Login_user::create([
                'cedula' => $request->cedula,
                'user' => $request->user,
                'password' => Hash::make($request->password)
            ]);
            
            Planilla::create([
                'cedula' => $request->cedula,
                'hora_trabajada'  => $request->hora_trabajada,
                'salario_h' => $request->sal_hora,
                'descuentos' => $request->descuento,
                'seguro_social' => $request->seguro_social,
                'seguro_educativo' => $request->seguro_educativo,
                'impuesto_renta' => $request->ir,
                'deducciones' => $request->deducciones,
                'salario_bruto' => $request->salario_bruto,
                'salario_neto' => $request->salario_neto
            ]);
            QrCode_user::create([
                'cedula' => $request->cedula,
                'qr_code' => $qrCodeBase64,
                'authcode' => $authcode
            ]);
            
            DB::commit();
            
            // Attempt to log in the user
            if (Auth::attempt(['user' => $request->user, 'password' => $request->password])) {
                return redirect(route('home'))->with("success", "User  successfully registered");
            }
            
            
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect(route("addEmployee"))->with("error",  "Error al registrar el empleado" . $ex->getMessage());

        }

        //$data['password'] = Hash::make($request->password);

        //$user = Employee::create($data);



        //if(!$user) {
        //    return redirect(route('addEmployee'))->with("error", "failed registration, try again");
        //}


        //$credential = $request -> only('user', 'password');
        //if(Auth::attempt(['user' => $credential['user'], 'password' => $credential['password']])) {
        //    return redirect(route('home'))->with("success","user succesfully registered");
        //}
    }

}
