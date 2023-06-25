<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Edge\EdgeController;
use App\Http\Controllers\Edge\Auth\LoginController;
use App\Http\Controllers\Edge\ReportsController;


Route::get('/clear-cache', function () {
    Artisan::call('optimize:clear');
    echo Artisan::output();
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('edge.showLoginForm');
Route::post('/login', [LoginController::class, 'login'])->name('edge.login');

Route::group(['middleware' => ['auth:admin']], function () {
    Route::get('/', [EdgeController::class, 'edgeDashboard'])->name('admin.home');
    Route::get('/dashboard', [EdgeController::class, 'edgeDashboard'])->name('edgeDashboard');
    Route::get('/logout', [LoginController::class, 'logout'])->name('edge.logout');
    Route::get('/invoice/{order_id}', [ReportsController::class, 'invoice'])->name('edge.reports.invoice'); 

    Route::get('users-list', [EdgeController::class, 'viewUserList'])->name('edge.user.list.view');
    Route::get('user-list', [EdgeController::class, 'getUserList'])->name('get.user.list');  
    
    Route::post('user-update', [EdgeController::class, 'editUserData'])->name('user.update.data');
    Route::get('/notification-read/{notification_id}', [EdgeController::class, 'notificationRead'])->name('edge.notificationRead');
    Route::get('/user-profile/{email}', [EdgeController::class, 'userProfile'])->name('edge.userProfile');
    Route::any('/user-edit', [EdgeController::class, 'editUser'])->name('edge.editUser');
    Route::any('/user-delete', [EdgeController::class, 'deleteUser'])->name('edge.deleteUser');
    
});
