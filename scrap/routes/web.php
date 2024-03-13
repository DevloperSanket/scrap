<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\UserController;

use App\Http\Controllers\Admin\DashboardController;

use App\Http\Controllers\Admin\ScrapcategoryController;

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
Route::get('/', [IndexController::class, 'index'])->name('index');


//user
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/login', [UserController::class, 'signin']);
    Route::get('/register', [UserController::class, 'register'])->name('register');
    Route::post('/register', [UserController::class, 'store']);
    Route::get('/about', [IndexController::class, 'about'])->name('about');
    Route::get('/contact', [IndexController::class, 'contact'])->name('contact');
    Route::get('/sell', [IndexController::class, 'sell'])->name('sell');
    Route::get('/allscrap', [IndexController::class, 'allscrap'])->name('allscrap');
    Route::get('/doortodoor',[IndexController::class, 'doortodoor'])->name('doortodoor');
    Route::get('/packaging',[IndexController::class, 'packaging'])->name('packaging');
    Route::get('/cunstruction',[IndexController::class,'cunstruction'])->name('cunstruction');
    Route::get('/itscrap', [IndexController::class, 'itscrap'])->name('itscrap');
    Route::get('/collage', [IndexController::class, 'collage'])->name('collage');
    Route::get('/bankscrap', [IndexController::class, 'bankscrap'])->name('bank-scrap');
    Route::get('/gov', [IndexController::class,'gov'])->name('gov-scrap');
    Route::get('/socity', [IndexController::class,'socity'])->name('socity-scrap');
    Route::get('/savegreen', [IndexController::class,'savegreen'])->name('savegreen');
    Route::get('/service',[IndexController::class,'service'])->name('service');
});

// Authenticated Routes
Route::group(['middleware' => 'auth'], function () {
    // Dashboard 
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/showdata',[DashboardController::class,'showTable'])->name('dashboard.show');
    Route::get('/show-table',[DashboardController::class,'data'])->name('dashboard-table');
    Route::post('/changeuserStatus',[DashboardController::class,'changeUserStatus'])->name('statusChange');

    // scrap category
    Route::get('/scrapcategory', [ScrapcategoryController::class, 'index'])->name('scrapcategory.index');
    Route::get('/scrapcreate', [ScrapcategoryController::class, 'create'])->name('scrapcategory.create');
    Route::post('/scrapcreate', [ScrapcategoryController::class, 'store'])->name('scrapcategory.store');
    Route::get('scrapdata', [ScrapcategoryController::class, 'scrapdata'])->name('scrapcategory.record');
    Route::post('/scrapchangeStatus', [ScrapcategoryController::class, 'scrapchangeStatus'])->name('scrapcategory.status');

    Route::get('/signout', [UserController::class, 'logout'])->name('signout');
});
