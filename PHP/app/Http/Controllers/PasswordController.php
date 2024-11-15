<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Login_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function index() {
        return view ('changePassword');
    }

    public function updatePassword(Request $request)
    {
        $user = auth()->user();
    
        $request->validate([
            'passwordOld' => 'required', 
            'passwordNew' => 'required|confirmed|min:8', 
        ]);
    
        // Verificar que la contraseña antigua sea correcta
        if (!Hash::check($request->passwordOld, $user->password)) {
            return redirect()->back()->with("error", "La contraseña actual no es correcta.");
        }
    
        // Verificar que la nueva contraseña no sea igual a la actual
        if (Hash::check($request->passwordNew, $user->password)) {
            return redirect()->back()->with("error", "La nueva contraseña no puede ser igual a la actual.");
        }
    
        $user->update([
            'password' => Hash::make($request->passwordNew),
        ]);
    
        return redirect()->back()->with("success", "La contraseña se ha cambiado correctamente.");
    }
    
}
