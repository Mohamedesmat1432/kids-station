<?php

use App\Http\Controllers\PagesController;
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

Route::get('/', [PagesController::class, 'index']);

Route::middleware(['auth:sanctum', 'role:user', config('jetstream.auth_session'), 'verified'])
    ->name('user.')->prefix('user')->group(function () {
        Route::controller(PagesController::class)->group(function () {
            Route::get('/dashboard', 'userDashboard')->name('dashboard');
        });
    });

Route::middleware(['auth:sanctum', 'role:support', config('jetstream.auth_session'), 'verified'])
    ->name('support.')->prefix('support')->group(function () {
        Route::controller(PagesController::class)->group(function () {
            Route::get('/dashboard', 'supportDashboard')->name('dashboard');
            Route::get('/companies', 'companies')->name('companies');
        });
    });

Route::middleware(['auth:sanctum', 'role:admin', config('jetstream.auth_session'), 'verified'])
    ->name('admin.')->prefix('admin')->group(function () {
        Route::controller(PagesController::class)->group(function () {
            Route::get('/dashboard', 'adminDashboard')->name('dashboard');
            Route::get('/users', 'users')->name('users');
            Route::get('/departments', 'departments')->name('departments');
            Route::get('/companies', 'companies')->name('companies');
            Route::get('/licenses', 'licenses')->name('licenses');
            Route::get('/devices', 'devices')->name('devices');
            Route::get('/patchs', 'patchs')->name('patchs');
            Route::get('/switchs', 'switchs')->name('switchs');
            Route::get('/ips', 'ips')->name('ips');
            Route::get('/edokis', 'edokis')->name('edokis');
            Route::get('/emad-edeens', 'emadEdeens')->name('emad-edeens');
        });
    });
