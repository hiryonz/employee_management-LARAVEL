<?php

namespace App\Http\Controllers\Gestion;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DirectionController;
use App\Http\Controllers\EmployeeController;
use App\Models\Task;
use Illuminate\Http\Request;

class LinkManager extends Controller
{

    function home() {
        return view("home" );

    }
    function login() {
        return view("login2");
    }

    function registration() {
        return view("addEmployee");
    }

    function viewEmployee() {
        $request = new Request();
        $employeeData = app(EmployeeController::class)->index($request);
        $directionData = app(DirectionController::class)->index($request);


        //dd($employeeData);

        return view ('viewEmployee', compact('employeeData', 'directionData'));

    }

    function addEmployee() {
        return view("addEmployee");
    }

    function viewEmployeeData() {
        return view("viewEmployeeData");
    }

    function task() {
        return view("task");
    }

    function calendar() {
        $tasks = Task::all()->toArray(); // Asegúrate de usar el modelo correcto
        
        // Mapea las tareas al formato de eventos de FullCalendar
        $events = array_map(function ($task) {
            return [
                'id' => $task['id'],
                'title' => $task['titulo'] . ' (' . $task['estado'] . ')', // Combina título y estado
                'start' => $task['fecha_limite'], // Fecha de inicio
                'end' => $task['fecha_limite'],     // Fecha límite
                'color' => $this->getPriorityColor($task['estado']), // Color según prioridad
            ];
        }, $tasks);
        
        // Retorna la vista con los eventos
        //dd($events);
        
        return view('calendarTask', compact('events'));
    }
    private function getPriorityColor($estado)
    {
        // Devuelve colores según prioridad
        switch ($estado) {
            case 'nuevo':
                return '#e3cf5a';
            case 'asignado':
                return '#bad9e4';
            case 'trabajando':
                return '#FFA07A';
            case 'revisar':
                return '#fa4120';
            default:
                return 'green';
        }
    }
}



