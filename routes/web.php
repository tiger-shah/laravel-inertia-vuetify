<?php

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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::inertia('register', 'Auth/Register')->name('register');
    Route::inertia('login', 'Auth/Login')->name('login');
});

Route::middleware('auth')->prefix('account')->group(function () {
    Route::redirect('/', 'account/dashboard')->name('account');

    Route::inertia('dashboard', 'Account/Dashboard')->name('account.dashboard');

    Route::get('users', [App\Http\Controllers\AccountController::class, 'showUsers'])->name('account.users');

    Route::get('setting', [App\Http\Controllers\AccountController::class, 'showSetting'])->name('account.setting');
    Route::put('setting', [App\Http\Controllers\AccountController::class, 'updateSetting'])->name('account.setting.update');

    Route::get('logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('account.logout');
});

Route::prefix('api')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::post('register', [App\Http\Controllers\AuthController::class, 'register'])->name('api.register');
        Route::post('login', [App\Http\Controllers\AuthController::class, 'login'])->name('api.login');
    });

    Route::middleware('auth')->group(function () {
    });
});
