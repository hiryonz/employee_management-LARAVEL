<?php

namespace App\Http\Controllers\Gestion;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DirectionController;
use App\Http\Controllers\EmployeeController;
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
        return view("calendarTask");
    }
}
