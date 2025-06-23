<?php

use App\Http\Controllers\PaymentController;
use App\Models\Tracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/tracking', function (Request $request) {
    $tracking = Tracking::create($request->all());
    return response()->json([
        'message' => 'Tracking data stored successfully.',
        'data' => $tracking,
    ], 201);
});

Route::post('/payment/notification', [PaymentController::class, 'handleNotification']);
