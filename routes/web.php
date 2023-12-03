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
    Route::prefix('register')->group(function () {
        Route::get('/', [App\Http\Controllers\AuthController::class, 'registerShow'])->name('register');

        Route::post('step_one',     [App\Http\Controllers\AuthController::class, 'registerStepOne'])->name('register.step1');
        Route::post('step_two',     [App\Http\Controllers\AuthController::class, 'registerStepTwo'])->name('register.step2');
        Route::post('step_three',   [App\Http\Controllers\AuthController::class, 'registerStepThree'])->name('register.step3');
    });

    Route::prefix('login')->group(function () {
        Route::inertia('/', 'Auth/Login')->name('login');
        Route::post('/', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
    });
});

Route::middleware('auth')->group(function () {
    Route::prefix('account')->group(function () {
        Route::redirect('/', 'account/dashboard')->name('account');

        Route::inertia('dashboard', 'Account/Dashboard')->name('account.dashboard');

        Route::inertia('messages', 'Account/Messages')->name('account.messages');

        Route::get('setting', [App\Http\Controllers\AccountController::class, 'showSetting'])->name('account.setting');
        Route::put('setting', [App\Http\Controllers\AccountController::class, 'updateSetting'])->name('account.setting.update');
    });

    Route::prefix('admin')->middleware('role:' . \App\Models\User::SuperAminRoleName)->group(function () {
        Route::redirect('/', 'admin/dashboard')->name('admin');

        Route::inertia('dashboard', 'Admin/Dashboard')->name('admin.dashboard');

        Route::get('users', [App\Http\Controllers\AdminController::class, 'showUsers'])->name('admin.users');
    });

    Route::get('logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
});
