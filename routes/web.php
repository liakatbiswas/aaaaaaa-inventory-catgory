<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\TokenVerificationMiddleware;

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

// web api routes
Route::post('/user-login', [UserController::class, 'login']);
Route::post('/user-registration', [UserController::class, 'registration']);
Route::post('/send-otp', [UserController::class, 'sendOtp']);
Route::post('/verify-otp', [UserController::class, 'verifyOtp']);
Route::post('/reset-password', [UserController::class, 'resetPassword'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/user-profile', [UserController::class, 'userProfile'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/user-profile-update', [UserController::class, 'updateUserProfile'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/logout', [UserController::class, 'logout']);


// page routes
Route::get('/login', [UserController::class, 'LoginPage']);
Route::get('/registration', [UserController::class, 'RegistrationPage']);
Route::get('/sendOtp', [UserController::class, 'SendOtpPage']);
Route::get('/verifyOtp', [UserController::class, 'VerifyOTPPage']);
Route::get('/resetPassword', [UserController::class, 'ResetPasswordPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/dashboard', [DashboardController::class, 'DashboardPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/userProfile', [UserController::class, 'profilePage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/categoryPage',[CategoryController::class,'categoryPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/productPage',[ProductController::class,'productPage'])->middleware([TokenVerificationMiddleware::class]);



// Category API
Route::post("/create-category",[CategoryController::class,'categoryCreate'])->middleware([TokenVerificationMiddleware::class]);
Route::get("/list-category",[CategoryController::class,'categoryList'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/update-category",[CategoryController::class,'categoryUpdate'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/delete-category",[CategoryController::class,'categoryDelete'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/category-by-id",[CategoryController::class,'categoryByID'])->middleware([TokenVerificationMiddleware::class]);




// Product API
Route::post("/create-product",[ProductController::class,'productCreate'])->middleware([TokenVerificationMiddleware::class]);
Route::get("/list-product",[ProductController::class,'productList'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/update-product",[ProductController::class,'productUpdate'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/delete-product",[ProductController::class,'productDelete'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/product-by-id",[ProductController::class,'productByID'])->middleware([TokenVerificationMiddleware::class]);

