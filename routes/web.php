<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Superadmin\SuperadminController;
use App\Http\Controllers\Designer\DesignerController;
use App\Http\Controllers\Guest\GuestController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CashpowerOperator\CashpowerOperatorController;
use App\Http\Controllers\CustomerService\CustomerServiceController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Technician\TechnicianController;


//---------------------Auth route--------------------

// Login routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Register routes
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);




//---------------------Superadmin Route---------------------
Route::middleware(['auth', 'checkrole:superadmin'])->group(function () {
    Route::get('/superadmin/dashboard', [SuperadminController::class, 'dashboard'])->name('superadmin.dashboard');
});

//---------------------Guest Route---------------------
Route::middleware(['auth', 'checkrole:guest,superadmin'])->group(function () {
    Route::get('/guest/dashboard', [GuestController::class, 'dashboard'])->name('guest.dashboard');
});

//---------------------Admin Route---------------------
Route::middleware(['auth', 'checkrole:admin,superadmin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

//---------------------Cashpower Operator Route---------------------
Route::middleware(['auth', 'checkrole:cashpower_operator,superadmin'])->group(function () {
    Route::get('/cashpower_operator/dashboard', [CashpowerOperatorController::class, 'dashboard'])->name('cashpower_operator.dashboard');
});

//---------------------Customer Service Route---------------------
Route::middleware(['auth', 'checkrole:customer_service,superadmin'])->group(function () {
    Route::get('/customer_service/dashboard', [CustomerServiceController::class, 'dashboard'])->name('customer_service.dashboard');
});

//---------------------Customer Route---------------------
Route::middleware(['auth', 'checkrole:customer,superadmin'])->group(function () {
    Route::get('/customer/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
});

//---------------------Technician Route---------------------
Route::middleware(['auth', 'checkrole:technician,superadmin'])->group(function () {
    Route::get('/technician/dashboard', [TechnicianController::class, 'dashboard'])->name('technician.dashboard');
});


//---------------------guest route--------------------
Route::middleware(['auth', 'checkrole:guest'])->group(function () {
    Route::get('/guest/dashboard', [GuestController::class, 'dashboard'])->name('guest.dashboard');
});




//---------------------Testing View--------------------
Route::get('/', function () {
    return view('auth.login');
});


Route::get('/testing', function () {
    return view('auth.test');
});

// Route::get('/', function () {
//     return view('welcome');
// });