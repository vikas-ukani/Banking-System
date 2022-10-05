<?php

use App\Http\Controllers\API\StripePaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::controller(RegisterController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::middleware('auth:sanctum')->group(function () {
    // Route::get('stripe', [StripePaymentController::class, 'stripe']);
    Route::post('stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.post');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
