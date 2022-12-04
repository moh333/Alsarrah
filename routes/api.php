<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ForgotPasswordController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\HomeController;
use App\Http\Controllers\API\ServiceController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\TechnicalController;
use App\Http\Controllers\API\RateController;
use App\Http\Controllers\API\SettingController;
use App\Http\Controllers\API\NotificationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v2'], function () {

    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::post('forgetpassword', [ForgotPasswordController::class, 'forgetpassword']);
    Route::post('activcode', [ForgotPasswordController::class, 'activcode']);
    Route::post('rechangepass', [ForgotPasswordController::class, 'rechangepass']);

    Route::group(['middleware' => 'auth:sanctum'], function() {
        Route::get('home', [HomeController::class , 'index']);
        Route::get('service/{id}', [ServiceController::class , 'show']);
        Route::post('companies', [CompanyController::class , 'index']);

        Route::post('order/add', [OrderController::class , 'add']);
        Route::get('orders', [OrderController::class , 'index']);
        Route::get('currentorders', [OrderController::class , 'index2']);
        Route::get('previousorders', [OrderController::class , 'index3']);
        Route::post('order/received', [OrderController::class , 'received']);

        Route::post('technical/order/add_price_offer', [TechnicalController::class , 'add_price_offer']);
        Route::get('technical/orders', [TechnicalController::class , 'index']);
        Route::get('technical/currentorders', [TechnicalController::class , 'index2']);
        Route::get('technical/previousorders', [TechnicalController::class , 'index3']);

        Route::get('notifications', [NotificationController::class , 'index']);

        Route::post('rates/add', [RateController::class , 'add']);
        Route::get('setting',[SettingController::class , 'index']);
        Route::get('profile', [ProfileController::class, 'profile']);
        Route::post('updateprofile', [ProfileController::class, 'updateprofile']);
        Route::post('changepassword', [ProfileController::class, 'changepassword']);
        Route::get('logout', [AuthController::class, 'logout']);
    });
});
