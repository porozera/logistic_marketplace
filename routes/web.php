<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\offerController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/landing-page', function () {
    return view('landing-page');
});

Route::get('/kelolarute', [OfferController::class, 'index'])->name('offers.index');
Route::get('/kelolarute/search', [OfferController::class, 'search'])->name('offers.search');



