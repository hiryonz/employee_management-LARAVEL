<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function  index() {
        //$columnsTask = ['id', 'cedula', 'decripcion', 'prioridad', 'fecha_creacion', 'fecha_limite', 'empleado_encargados'];
        //$dataTask = Task::all($columnsTask)->toArray();

        //return view('home', compact('columnsTask','dataTask'));
    }

}
