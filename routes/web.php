<?php

use App\Http\Controllers\ContainerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/landing-page', function () {
    return view('landing-page');
});

// Route::get('/kontainer', function () {
//     return view('admin.kontainer');
// });

// Route::get('/kontainer-add', function () {
//     return view('admin.kontainer-add');
// });

// ContaninerController
Route::get('kontainer', [ContainerController::class,'index']);
Route::get('kontainer-add', [ContainerController::class,'add']);
Route::post('kontainer-add', [ContainerController::class,'store']);