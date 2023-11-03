<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthLogin;

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

Route::middleware('guest')->prefix('')->name('guest.')->controller(GuestController::class)->group(function () {
    Route::get('/','login')->name('login');
    Route::post('/auth-login','authLogin')->name('authLogin');
});

Route::middleware(AuthLogin::class)->prefix('admin')->name('admin.')->controller(AdminController::class)->group(function () {
    Route::get('/', 'dashboard')->name('dashboard');
    Route::get('/logout', 'logout')->name('logout');
    Route::prefix('products')->group(function(){
        Route::get('/', 'products')->name('products');
        Route::post('/create', 'create')->name('products.create');
        Route::post('/update/{id}', 'update')->name('products.update');
        Route::post('/delete', 'delete')->name('products.delete');
    });
});
