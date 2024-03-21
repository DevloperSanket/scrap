<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\SellController;

use App\Http\Controllers\Admin\DashboardController;

use App\Http\Controllers\Admin\ScrapcategoryController;
use App\Http\Controllers\Admin\PincodeController;
use App\Http\Controllers\Admin\CardController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\UserDashboardController;
use App\Http\Controllers\Admin\SellScrapController;
use App\Http\Controllers\Admin\MyprofileController;


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
    // Route::get('/sell', [IndexController::class, 'sell'])->name('sell');
    Route::get('/allscrap', [IndexController::class, 'allscrap'])->name('allscrap');
    Route::get('/ElectronicScrap', [IndexController::class, 'ElectronicScrap'])->name('electronic-scrap');
    Route::get('/appliances', [IndexController::class, 'appliances'])->name('appliances');
    Route::get('/furniture', [IndexController::class, 'furniture'])->name('furniture');
    Route::get('/papar', [IndexController::class, 'papar'])->name('papar');
    Route::get('/plastic', [IndexController::class, 'plastic'])->name('plastic');
    Route::get('/steel', [IndexController::class, 'steel'])->name('steel');
    Route::get('/gov', [IndexController::class, 'gov'])->name('gov-scrap');
    Route::get('/Ironscrap', [IndexController::class, 'Ironscrap'])->name('iron-scrap');
    Route::get('/savegreen', [IndexController::class, 'savegreen'])->name('savegreen');
    Route::get('/service', [IndexController::class, 'service'])->name('service');
    Route::post('/contact/send', [ContactController::class, 'sendEmail'])->name('contact.send');


    // direct sell routes
    Route::get('index',[SellController::class,'index'])->name('sell.index');
    Route::post('/index', [SellController::class, 'store'])->name('directsell.store');
    Route::get('directselldata', [SellController::class, 'directselldata'])->name('directsell.record');
   
    


});

// Authenticated Routes for super Admin
Route::group(['middleware' => 'auth','superadmin'], function () {
    // Dashboard 
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/showdata', [DashboardController::class, 'showTable'])->name('dashboard.show');
    Route::get('/show-table', [DashboardController::class, 'data'])->name('dashboard-table');
    // direct sell
    Route::get('/showdirectselldata', [DashboardController::class, 'showdirectselldata'])->name('dashboard.showdirectsell');
    Route::get('/show-directselltable', [DashboardController::class, 'directselldata'])->name('dashboard-directselltable');
    Route::post('/changeuserStatus', [DashboardController::class, 'changeUserStatus'])->name('statusChange');
    Route::post('/changedirectsellStatus', [DashboardController::class, 'directsellStatus'])->name('directsellstatusChange');
    Route::post('/changedirectselldriver', [DashboardController::class, 'directsellDriver'])->name('directselldriverChange');
    // registered sell
    Route::get('/showregisteredselldata', [DashboardController::class, 'showregisteredselldata'])->name('dashboard.showregisteredsell');
    Route::get('/show-registeredselltable', [DashboardController::class, 'scrapRecord'])->name('dashboard-registeredselltable');
    Route::post('/changeregisteredsellStatus', [DashboardController::class, 'registeredsellStatus'])->name('registeredsellstatusChange');
    Route::post('/changeregisteredselldriver', [DashboardController::class, 'registeredsellDriver'])->name('registeredselldriverChange');



    // scrap category
    Route::get('/scrapcategory', [ScrapcategoryController::class, 'index'])->name('scrapcategory.index');
    Route::get('/scrapcreate', [ScrapcategoryController::class, 'create'])->name('scrapcategory.create');
    Route::post('/scrapcreate', [ScrapcategoryController::class, 'store'])->name('scrapcategory.store');
    Route::get('scrapdata', [ScrapcategoryController::class, 'scrapdata'])->name('scrapcategory.record');
    Route::post('/scrapchangeStatus', [ScrapcategoryController::class, 'scrapchangeStatus'])->name('scrapcategory.status');
    Route::get('/edit-scrap/{id}', [ScrapcategoryController::class, 'edit'])->name('scrapcategory.edit');
    Route::post('/update-scrap', [ScrapcategoryController::class, 'update'])->name('scrapcategory.update');
    Route::post('/delete-scrap', [ScrapcategoryController::class, 'delete'])->name('scrapcategory.delete');


    // pincode routes
    Route::get('/pincode', [PincodeController::class, 'index'])->name('pincode.index');
    Route::get('/pincodecreate', [PincodeController::class, 'create'])->name('pincode.create');
    Route::post('/pincodecreate', [PincodeController::class, 'store'])->name('pincode.store');
    Route::get('pincodedata', [PincodeController::class, 'pincodedata'])->name('pincode.record');
    Route::post('/pincodechangeStatus', [PincodeController::class, 'pincodechangeStatus'])->name('pincode.status');
    Route::get('/edit-pincode/{id}', [PincodeController::class, 'edit'])->name('pincode.edit');
    Route::post('/update-pincode', [PincodeController::class,'update'])->name('pincode.update');
    Route::post('/delete-pincode', [PincodeController::class,'delete'])->name('pincode.delete');

    
    // card routes
    Route::get('/card', [CardController::class, 'index'])->name('card.index');
    Route::get('/cardcreate', [CardController::class, 'create'])->name('card.create');
    Route::post('/cardcreate', [CardController::class, 'store'])->name('card.store');
    Route::get('/carddata', [CardController::class, 'carddata'])->name('card.record');
    Route::post('/card-Status', [CardController::class, 'cardchangeStatus'])->name('card.status');
    Route::get('/edit-card/{id}', [CardController::class, 'edit'])->name('card.edit');
    Route::post('/update-card', [CardController::class, 'update'])->name('card.update');
    Route::post('/delete-card', [CardController::class, 'delete'])->name('card.delete');


    // driver routes
    Route::get('/driver', [DriverController::class, 'index'])->name('driver.index');
    Route::get('/drivercreate', [DriverController::class, 'create'])->name('driver.create');
    Route::post('/drivercreate', [DriverController::class, 'store'])->name('driver.store');
    Route::get('/driverdata', [DriverController::class, 'driverdata'])->name('driver.record');
    Route::post('/driverstatuschange', [DriverController::class, 'driverstatuschange'])->name('driver.status');
    Route::get('/edit-driver/{id}', [DriverController:: class, 'edit'])->name('driver.edit');
    Route::post('/update-driver', [DriverController::class, 'update'])->name('driver.update');
    Route::post('/delete-driver', [DriverController::class, 'delete'])->name('driver.delete');


    Route::get('/signout', [UserController::class, 'logout'])->name('signout');
});


// Authenticated Routes for UserAdmin
Route::group(['middleware'=> 'auth', 'UserAdmin'], function (){
    Route::get('userAdmin-dashboard',[UserDashboardController::class,'index'])->name('user.dashboard');


    // sell scrap routes
    Route::get('userAdmin-sellscrap',[SellScrapController::class,'index'])->name('scrap.index');
    Route::get('userAdmin-create',[SellScrapController::class,'create'])->name('scrap.create');
    Route::post('userAdmin-store',[SellScrapController::class,'store'])->name('scrap.store');
    Route::get('useradmin-getdata',[SellScrapController::class,'scrapRecord'])->name('scrap.getdata');


    // user profile routes 
    Route::get('userProfile-index', [MyprofileController::class, 'index'])->name('profile.index');
    Route::get('/edit-profile', [MyprofileController::class, 'edit'])->name('profile.edit');
    Route::post('/update-profile', [MyprofileController::class,'update'])->name('profile.update');
    Route::get('/userProfile-editpassword', [MyprofileController::class, 'editpassword'])->name('profile.editpassword');
Route::post('/userProfile-updatepassword', [MyprofileController::class, 'updatePassword'])->name('profile.updatepassword');
});

