<?php

use App\Http\Controllers\EmployeeController;
use App\Models\employee;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('masster');
});
Route::get('/welcome', function () {
    return view('welcome');
});
Route::resource('employees', EmployeeController::class);
Route::delete('employees/{employee}/forcedestroy', [EmployeeController::class, 'forcedestroy'])
->name('employees.forcedestroy');