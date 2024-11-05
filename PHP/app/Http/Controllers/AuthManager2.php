<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Direction;
use App\Models\Employee;
use App\Models\Login_user;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class AuthManager2 extends Controller
{



    function loginPost(request $request) {
        $request -> validate([
            "user"=> "required|String",
            "password" => "required|String"
        ]);

        $credential = $request -> only('user', 'password');

        if(Auth::attempt(['user' => $credential['user'], 'password' => $credential['password']])) {
            return redirect(route('home'));
        }

        return redirect(route('login2'))->with("error", "username or password incorrect");
    }

    function registrationPost(Request $request){
  
    }

    function logout() {
        Session::flush();
        Auth::logout();
        return redirect(route('login2'));
    }
}
