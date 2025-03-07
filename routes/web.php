<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/landing-page', function () {
    return view('landing-page');
});

Route::get('/register-customer', [RegisterController::class, 'create_customer'])->middleware('guest')->name('register-customer');
Route::post('/register-customer', [RegisterController::class, 'store_customer'])->middleware('guest')->name('register-customer.perform');
Route::get('/register-lsp', [RegisterController::class, 'create_lsp'])->middleware('guest')->name('register-lsp');
Route::post('/register-lsp', [RegisterController::class, 'store_lsp'])->middleware('guest')->name('register-lsp.perform');
Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
// Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
// Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
// Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
// Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
// Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');



Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index_admin']);
});

Route::middleware(['auth', RoleMiddleware::class . ':lsp'])->group(function () {
    Route::get('/lsp/dashboard', [DashboardController::class, 'index']);
});

Route::middleware(['auth', RoleMiddleware::class . ':customer'])->group(function () {
    Route::get('/customer/dashboard', [DashboardController::class, 'index_admin']);
});
