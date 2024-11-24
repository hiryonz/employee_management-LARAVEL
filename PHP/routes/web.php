<?php

use App\Http\Controllers\addEmployeeController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Gestion\LinkManager;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ViewEmployeeController;
use App\Http\Controllers\ViewEmployeeDataController;
use App\Http\Middleware\VerifyAdmin;
use App\Http\Middleware\verifyEmployeeId;
use Illuminate\Auth\AuthManager;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager2;
use App\Http\Middleware\ValidadeAuth;



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/login2', [LinkManager::class, 'login'])->name('login2');
Route::post('/login2', [authmanager2::class, 'loginPost'])->name('login.post');


Route::middleware([ValidadeAuth::class])->group(function() {
    //Route::get('/', [LinkManager::class, 'home'])->name('home');
    Route::get('/getPassword', [PasswordController::class, 'index'])->name('get.password');
    Route::post('/changePassword', [PasswordController::class, 'updatePassword'])->name('change.password');

    Route::middleware([VerifyAdmin::class])->group( function() {
        Route::get('/viewEmployeeData/{id}', [ViewEmployeeDataController::class, 'index'])->name('viewEmployeeData');
        Route::get('/viewEmployee', [ViewEmployeeController::class, 'index'])->name('viewEmployee');
        Route::get('/addEmployee', [addEmployeeController::class, 'index'])->name('addEmployee');
        Route::post('/viewEmployeeData/{id}/update', [ViewEmployeeDataController::class, 'update'])->name('updateEmployee.post');
        Route::delete('/viewEmployeeData/{id}/destroy', [ViewEmployeeDataController::class, 'destroy'])->name('destroyEmployee.post');
        Route::post('/viewEmployeeData/{id}/updateImg', [ViewEmployeeDataController::class, 'updateImg'])->name('updateImg.post');
        //se usa delete porque es un metodo http
        Route::post('/registration', [addEmployeeController::class, 'create'])->name('registration.post');
        Route::get('/home', [HomeController::class, 'index'])->name('home');
        Route::get('/', [HomeController::class, 'index'])->name('data.index');

        Route::post('/task/add', [TaskController::class, 'create'])->name('addTask');
        Route::post('/task/update', [TaskController::class, 'update'])->name('updateTask');
        Route::post('/task/updateState', [TaskController::class, 'updateState'])->name('updateTaskState');
        Route::post('/tasks/destroy', [TaskController::class, 'destroy'])->name('tasks.destroy');


    });

    
    Route::get('/homeEmployee', [HomeController::class, 'index'])->name('homeEmployee');



    Route::get('/task', [TaskController::class, 'index'])->name('task');
    Route::get('/calendar', [LinkManager::class, 'calendar'])->name('calendar');

});


Route::get("/logout", [authmanager2::class, 'logout'])->name('logout');

    


require __DIR__.'/auth.php';
