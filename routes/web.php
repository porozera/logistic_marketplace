<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Models\Service;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/landing-page', function () {
    return view('landing-page');
});

// Service
Route::get('service', [ServiceController::class,'index']);
Route::get('service-add', [ServiceController::class,'add']);
Route::post('service-add', [ServiceController::class,'store']);
Route::get('service/{id}/edit', [ServiceController::class, 'edit']);
Route::put('service/{id}', [ServiceController::class, 'update']);
Route::delete('service/{id}', [ServiceController::class, 'destroy'])->name('service.destroy');
