<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\offerController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/landing-page', function () {
    return view('landing-page');
});


Route::prefix('offers')->group(function(){
    Route::get('/', [OfferController::class, 'index'])->name('offers.index');
    Route::get('search', [OfferController::class, 'search'])->name('offers.search');
    Route::get('create', [OfferController::class, 'create'])->name('offers.create');
    Route::post('store', [OfferController::class, 'store'])->name('offers.store');
    Route::get('/{id}', [OfferController::class, 'show'])->name('offers.show');
    Route::get('/{id}/edit', [OfferController::class, 'edit'])->name('offers.edit');
    Route::put('/{id}', [OfferController::class, 'update'])->name('offers.update');
    Route::delete('/{id}', [OfferController::class, 'destroy'])->name('offers.destroy');
});



