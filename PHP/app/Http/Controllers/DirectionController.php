<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Direction;
use Illuminate\Http\Request;

class DirectionController extends Controller
{
    function index(Request $request) {
        $directionInfo = Direction::all();
        
            $direction = [
                'direction' => [
                    'columns' => array_map(function($column) {
                                    return str_replace('_', ' ', $column);
                                }, array_keys($directionInfo->first()->getAttributes())),
                    'data' => $directionInfo
                ]
            ];


        return $direction;
    }
}
