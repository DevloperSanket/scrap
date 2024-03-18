<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\UserController;

use App\Http\Controllers\Admin\DashboardController;

use App\Http\Controllers\Admin\ScrapcategoryController;
use App\Http\Controllers\Admin\PincodeController;
use App\Http\Controllers\Admin\CardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\UserDashboardController;
use App\Http\Controllers\Admin\SellScrapController;

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
    Route::get('/ElectronicScrap', [IndexController::class, 'ElectronicScrap'])->name('electronic-scrap');
    Route::get('/appliances', [IndexController::class, 'appliances'])->name('appliances');
    Route::get('/furniture', [IndexController::class, 'furniture'])->name('furniture');
    Route::get('/itscrap', [IndexController::class, 'itscrap'])->name('itscrap');
    Route::get('/collage', [IndexController::class, 'collage'])->name('collage');
    Route::get('/bankscrap', [IndexController::class, 'bankscrap'])->name('bank-scrap');
    Route::get('/gov', [IndexController::class, 'gov'])->name('gov-scrap');
    Route::get('/Ironscrap', [IndexController::class, 'Ironscrap'])->name('iron-scrap');
    Route::get('/savegreen', [IndexController::class, 'savegreen'])->name('savegreen');
    Route::get('/service', [IndexController::class, 'service'])->name('service');
    Route::post('/contact/send', [ContactController::class, 'sendEmail'])->name('contact.send');
});

// Authenticated Routes for super Admin
Route::group(['middleware' => 'auth','superadmin'], function () {
    // Dashboard 
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/showdata', [DashboardController::class, 'showTable'])->name('dashboard.show');
    Route::get('/show-table', [DashboardController::class, 'data'])->name('dashboard-table');
    Route::post('/changeuserStatus', [DashboardController::class, 'changeUserStatus'])->name('statusChange');

    // scrap category
    Route::get('/scrapcategory', [ScrapcategoryController::class, 'index'])->name('scrapcategory.index');
    Route::get('/scrapcreate', [ScrapcategoryController::class, 'create'])->name('scrapcategory.create');
    Route::post('/scrapcreate', [ScrapcategoryController::class, 'store'])->name('scrapcategory.store');
    Route::get('scrapdata', [ScrapcategoryController::class, 'scrapdata'])->name('scrapcategory.record');
    Route::post('/scrapchangeStatus', [ScrapcategoryController::class, 'scrapchangeStatus'])->name('scrapcategory.status');
    Route::get('/edit-scrap/{id}', [ScrapcategoryController::class, 'edit'])->name('scrapcategory.edit');
    Route::post('/update-scrap', [ScrapcategoryController::class, 'update'])->name('scrapcategory.update');
    Route::post('/delete-scrap', [ScrapcategoryController::class, 'delete'])->name('scrapcategory.delete');

    // pincode 
    Route::get('/pincode', [PincodeController::class, 'index'])->name('pincode.index');
    Route::get('/pincodecreate', [PincodeController::class, 'create'])->name('pincode.create');
    Route::post('/pincodecreate', [PincodeController::class, 'store'])->name('pincode.store');
    Route::get('pincodedata', [PincodeController::class, 'pincodedata'])->name('pincode.record');
    Route::post('/pincodechangeStatus', [PincodeController::class, 'pincodechangeStatus'])->name('pincode.status');
    Route::get('/edit-pincode/{id}', [PincodeController::class, 'edit'])->name('pincode.edit');
    Route::post('/update-pincode', [PincodeController::class,'update'])->name('pincode.update');
    Route::post('/delete-pincode', [PincodeController::class,'delete'])->name('pincode.delete');

    
    Route::get('/card', [CardController::class, 'index'])->name('card.index');
    Route::get('/cardcreate', [CardController::class, 'create'])->name('card.create');
    Route::post('/cardcreate', [CardController::class, 'store'])->name('card.store');
    Route::get('/carddata', [CardController::class, 'carddata'])->name('card.record');
    Route::post('/cardstatuschange', [CardController::class, 'cardstatuschange'])->name('card.status');
    Route::get('/edit-card/{id}', [CardController::class, 'edit'])->name('card.edit');
    Route::post('/update-card', [CardController::class, 'update'])->name('card.update');
    Route::post('/delete-card', [CardController::class, 'delete'])->name('card.delete');


    Route::get('/signout', [UserController::class, 'logout'])->name('signout');
});

// Authenticated Routes for UserAdmin
Route::group(['middleware'=> 'auth', 'UserAdmin'], function (){
    Route::get('userAdmin-dashboard',[UserDashboardController::class,'index'])->name('user.dashboard');

    // sell scrap routes
    Route::get('userAdmin-sellscrap',[SellScrapController::class,'index'])->name('scrap.index');
    Route::get('userAdmin-create',[SellScrapController::class,'create'])->name('scrap.create');
});

