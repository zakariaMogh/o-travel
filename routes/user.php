<?php


use Illuminate\Support\Facades\Route;


Route::post('register',[\App\Http\Controllers\Api\Company\Auth\RegisterController::class,'register'])->name('register');
Route::post('login',[\App\Http\Controllers\Api\Company\Auth\CompanyLoginController::class,'login'])->name('login');


Route::middleware('auth:company')->group(function (){
    Route::get('me',[\App\Http\Controllers\Api\Company\Auth\CompanyLoginController::class,'me'])->name('name');
    Route::post('logout',[\App\Http\Controllers\Api\Company\Auth\CompanyLoginController::class,'logout'])->name('logout');
    Route::post('upload/image',[\App\Http\Controllers\Api\Company\Auth\CompanyLoginController::class,'uploadImage'])->name('upload.image');
    Route::put('update',[\App\Http\Controllers\Api\Company\Auth\CompanyLoginController::class,'update'])->name('update');
});