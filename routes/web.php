<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('login/{social}', [LoginController::class, 'socialLogin'])->name('auth.social');
Route::get('login/{social}/callback', [LoginController::class, 'handleProviderCallback']);

Route::get('/dashboard', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';


Route::middleware('auth')->group(function () {
    Route::get('user/add-fund', [UserController::class, 'addFundToWalletView'])->name('user.add-fund');
    Route::post('user/add-money', [UserController::class, 'addFundToWallet'])->name('user.add-fund-wallet');
    Route::get('/send-money/{id}', [TransactionController::class, 'sendMoneyPage'])->name('user.sendMoney');
    Route::post('user/send-money', [UserController::class, 'sendMoneyFromWallet'])->name('user.send-money');

    Route::get('user-invoice', [UserController::class, 'generateInvoice'])->name('generate-invoice');
});
