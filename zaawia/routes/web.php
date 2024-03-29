<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('verify-mail/{token}', [AuthController::class, 'verifyEmail'])->name('verify.email');
Route::get('forget-password', [AuthController::class, 'resetPasswordLoad']);
Route::post('forget-password', [AuthController::class, 'resetPassword'])->name('change.email');
