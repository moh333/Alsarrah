<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProviderController;
use App\Http\Controllers\Admin\AdminMemberController;
use App\Http\Controllers\Admin\AdminServiceController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminBannerController;
use App\Http\Controllers\Admin\AdminGalleryController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminPartnerController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

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
Route::get('/', function() {
    return redirect()->route('admin.dashboard');
});

Route::get('/clearcache185', function () {
    $clearcache = Artisan::call('cache:clear');
    echo "Cache cleared<br>";

    $clearview = Artisan::call('view:clear');
    echo "View cleared<br>";

    $clearconfig = Artisan::call('config:cache');
    echo "Config cleared<br>";

    $sotagelink = \Illuminate\Support\Facades\Artisan::call('storage:link');
});

Route::get('admin/login', [AdminLoginController::class, 'index'])->name('admin.index');
Route::post('admin/login', [AdminLoginController::class, 'login'])->name('admin.login');
Route::get('admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

Route::group(['middleware' => 'adminauth:admin', 'prefix' => 'admin'],function(){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('provider', ProviderController::class);
    Route::resource('users', AdminMemberController::class);
    Route::get('technicals', [AdminMemberController::class , 'index2']);
    Route::get('technicals/new', [AdminMemberController::class , 'index3']);
    Route::resource('service', AdminServiceController::class);
    Route::resource('gallery', AdminGalleryController::class);
    Route::resource('category', AdminCategoryController::class);
    Route::resource('banner', AdminBannerController::class);
    Route::resource('partner', AdminPartnerController::class);
    Route::resource('order', AdminOrderController::class);
    Route::resource('setting', AdminSettingController::class);
});

Auth::routes();
Route::get('/OTP/vertify',[RegisterController::class , 'index'])->name('order.index');
