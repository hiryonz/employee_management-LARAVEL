<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SaveFilterController extends Controller
{
    public function saveFilter(Request $request)
    {
        $tipo = $request->input('type'); // Ejemplo: 'fecha' o 'prioridad'
        $valor = $request->input('filter-input'); // El valor del filtro
        // Guardar el filtro en la sesión
        session([$tipo => $valor]);
        //dd(session());
        // Redirigir de vuelta a la vista principal
        return redirect()->back(); // Ajusta la ruta según tu aplicación
    }
}
