<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', [UserController::class, 'login']);
Route::post('/registration', [UserController::class, 'registration']);
Route::post('/sendOtp', [UserController::class, 'sendOtp']);
Route::post('/verifyOtp', [UserController::class, 'verifyOtp']);
