<?php

use App\Http\Controllers\AuthController;
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
    return view('welcome');
});

Route::get('/movies', [AuthController::class, 'movies'])
->name('movies')->middleware('auth','movies');

Route::get('/showregister', [AuthController::class, 'ShowRegister'])->name('showregister');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class , 'showLogin'])->name('showLogin');
Route::post('login', [AuthController::class , 'login'])->name('login');


Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard')
->middleware(['auth']);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/quenmk', [AuthController::class, 'quenMk'])
->middleware('guest')->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'forgot_password'])
->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])
->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])
->name('password.update');


Route::group(['middleware'=>['auth']], function () {
    Route::group(['middleware'=>['role:admin']], function () {
        Route::get('/admin',[AuthController::class,'admin'])
        ->name('admin');
    });
    
    Route::group(['middleware'=>['role:nhanVien']], function () {
        Route::get('/nhanVien',[AuthController::class, 'nhanVien'])
        ->name('nhanVien');
    });
    
    Route::group(['middleware'=>['role:khachHang']], function () {
        Route::get('/profile', [AuthController::class, 'profile'])
        ->name('profile');
    });
    
} );
