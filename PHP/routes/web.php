<?php

use App\Http\Controllers\addEmployeeController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Gestion\LinkManager;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ViewEmployeeController;
use App\Http\Controllers\ViewEmployeeDataController;
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
    Route::get('/addEmployee', [addEmployeeController::class, 'index'])->name('addEmployee');
    
    Route::get('/viewEmployee', [ViewEmployeeController::class, 'index'])->name('viewEmployee');
    Route::get('/viewEmployeeData/{id}', [ViewEmployeeDataController::class, 'index'])->name('viewEmployeeData');
    Route::post('/viewEmployeeData/{id}/update', [ViewEmployeeDataController::class, 'update'])->name('updateEmployee.post');
    Route::delete('/viewEmployeeData/{id}/destroy', [ViewEmployeeDataController::class, 'destroy'])->name('destroyEmployee.post');
    Route::put('/viewEmployeeData/{id}/updateImg', [ViewEmployeeDataController::class, 'updateImg'])->name('updateImg.post');
    //se usa delete porque es un metodo http
    Route::post('/registration', [addEmployeeController::class, 'create'])->name('registration.post');

    
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/', [HomeController::class, 'index'])->name('data.index');


    Route::get('/task', [LinkManager::class, 'task'])->name('task');
    Route::get('/calendar', [LinkManager::class, 'calendar'])->name('calendar');
    Route::get('/employee', action: [EmployeeController::class, 'index'])->name('employee.index');
});


Route::get("/logout", [authmanager2::class, 'logout'])->name('logout');

    


require __DIR__.'/auth.php';
