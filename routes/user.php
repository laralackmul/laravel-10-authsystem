<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\Auth\RegisterController;


Route::get('/clear-cache', function () {
    Artisan::call('optimize:clear');
    echo Artisan::output();
});


Route::group(['middleware' =>['auth']], function () {
    Route::get('/', [UserController::class, 'userDashboard'])->name('userHome');
    Route::get('/dashboard', [UserController::class, 'userDashboard'])->name('userDashboard');
    Route::get('/logout', [LoginController::class, 'logout'])->name('user.logout');   
    Route::get('/user-account', [UserController::class, 'userAccount'])->name('userAccount');
    Route::get('/notification-read/{notification_id}', [UserController::class, 'notificationRead'])->name('user.notificationRead');
    Route::get('/edit-user-account', [UserController::class, 'editUserForm'])->name('user.editUserForm');
    Route::post('/edit-user-account', [UserController::class, 'editUserAccount'])->name('user.edit.account');
    
});
