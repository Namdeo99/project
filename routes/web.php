<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Controller;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    

    // $user = user::find(1);
    // User::find(1)->notify(new TaskCompleted)->delay(1000);

    return view('welcome');
});

//notification route here

Route::get('/fcm' , [Controller::class, 'index']);
Route::get('/send-notification' , [Controller::class, 'sendNotification']);
//end notification route here

Route::get('students' , [StudentController::class, 'index']);
Route::post('student' , [StudentController::class, 'store']);
Route::get('fetch-students' , [StudentController::class, 'fetchstudents']);
Route::get('edit-student/{id}' , [StudentController::class, 'edit']);
Route::put('update-student/{id}' , [StudentController::class, 'update']);

Route::get('/employee' , [EmployeeController::class, 'index']);
Route::post('/employee/save', [EmployeeController::class, 'store'])->name('employee.save');
Route::get('/edit-employee/{id}', [EmployeeController::class, 'edit']);
Route::put('/update-employee', [EmployeeController::class, 'update']);
Route::delete('/delete-employee', [EmployeeController::class, 'destroy']);

//Route::livewire('show', 'ShowPosts');

//Route::resource('employee' , [EmployeeController::class, 'index']);
//Route::resource('employee', 'EmployeeController');
