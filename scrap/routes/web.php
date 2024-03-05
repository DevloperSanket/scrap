<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\UserController;

use App\Http\Controllers\Admin\DashboardController;

use App\Http\Controllers\Admin\DoctorrecordController;


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


// Frontend Routes
Route::get('/', [IndexController::class, 'index']);


//user
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/login',[UserController::class,'signin']);
    Route::get('/register', [UserController::class, 'register'])->name('register');
    Route::post('/register', [UserController::class, 'store']);
});

// Authenticated Routes
Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/doctor',[DoctorrecordController::class,'index'])->name('doctor.index');
    Route::get('/doctor-create',[DoctorrecordController::class,'create'])->name('doctor.create');
    Route::post('/doctor-create',[DoctorrecordController::class,'store'])->name('doctore.store');
    Route::get('data',[DoctorrecordController::class,'data'])->name('admin.data');
    Route::post('/changeStatus', [DoctorrecordController::class, 'changeStatus'])->name('doctor.status');
    Route::get('/signout',[UserController::class,'logout'])->name('signout');
});
