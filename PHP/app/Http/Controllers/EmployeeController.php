<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Direction;
use App\Models\Employee;
use App\Models\Planilla;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    function index(Request $request) {
        $employeeInfo = Employee::all();
        $directionInfo = Direction::all();
        $planillaInfo = Planilla::all();

            $employee = [
                    'columns' => array_map(function($column) {
                                    return str_replace('_', ' ', $column);
                                }, array_keys($employeeInfo->first()->getAttributes())),
                    'data' => $employeeInfo
            ];

        
        return $employeeInfo;
    }
}
