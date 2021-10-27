<?php

use Illuminate\Support\Facades\Route;


Route::get('login',[\App\Http\Controllers\Web\Admin\Auth\AdminLoginController::class,'index'])->name('login.index');
Route::post('login',[\App\Http\Controllers\Web\Admin\Auth\AdminLoginController::class,'login'])->name('login');

Route::get('password/reset/{token}',[\App\Http\Controllers\Web\Admin\Auth\ResetPasswordController::class,'showResetForm'])->name('password.reset');
Route::post('password/reset',[\App\Http\Controllers\Web\Admin\Auth\ResetPasswordController::class,'reset'])->name('reset');

Route::get('forgot/password',[\App\Http\Controllers\Web\Admin\Auth\ForgotPasswordController::class,'showLinkRequestForm'])->name('forgot.password.email');
Route::post('forgot/password',[\App\Http\Controllers\Web\Admin\Auth\ForgotPasswordController::class,'sendResetLinkEmail'])->name('forgot.password.send');

Route::middleware('auth:admin')->group(function (){
    Route::any('logout',[\App\Http\Controllers\Web\Admin\Auth\AdminLoginController::class,'logout'])->name('logout');



    Route::get('dashboard',[\App\Http\Controllers\Web\Admin\DashboardController::class,'index'])->name('dashboard');

    Route::GET("setting",[\App\Http\Controllers\Web\Admin\SettingsController::class,'index'])->name("setting.index");
    Route::POST("setting",[\App\Http\Controllers\Web\Admin\SettingsController::class,'update'])->name("setting.update");

    Route::get('admins/{id}/edit-password',[\App\Http\Controllers\Web\Admin\AdminController::class,'editPassword'])->name('admins.edit-password');
    Route::put('admins/{id}/edit-password',[\App\Http\Controllers\Web\Admin\AdminController::class,'updatePassword'])->name('admins.update-password');
    Route::resource('admins', \App\Http\Controllers\Web\Admin\AdminController::class);
    Route::get('roles/permissions',[\App\Http\Controllers\Web\Admin\RoleController::class,'getPermissionsList'])->name('roles.permissions.index');
    Route::resource('roles', \App\Http\Controllers\Web\Admin\RoleController::class)->except('show');

});


