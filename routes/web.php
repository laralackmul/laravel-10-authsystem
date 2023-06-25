<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\Auth\RegisterController;
use App\Http\Controllers\GenericController;



Route::get('/c-clean', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('optimize:clear');
    session()->flush();
    return env('APP_NAME') . " All cache cleared.";
});
//Auth section start
Route::get('/', [LoginController::class, 'showLoginForm'])->name('user.home')->middleware(['blockUserIP']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('user.showLoginForm')->middleware(['blockUserIP']);
Route::post('/login', [LoginController::class, 'login'])->name('user.login');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('user.showRegistrationForm');
Route::post('/register', [RegisterController::class, 'register'])->name('user.register');
Route::get('public_profile/{id?}', [GenericController::class, 'publicProfile'])->name('publicProfile');
Route::get('block-ip-msg',[GenericController::class, 'showIpBlock'])->name('block.ip');
//Auth section end
