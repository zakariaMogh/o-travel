<?php


use Illuminate\Support\Facades\Route;


Route::post('register',[\App\Http\Controllers\Api\Company\Auth\RegisterController::class,'register'])->name('register');
