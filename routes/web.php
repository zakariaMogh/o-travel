<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::redirect('/', 'admin/login');


Route::get('migrate',[\App\Http\Controllers\ArtisanController::class,'migrate']);
Route::get('seed',[\App\Http\Controllers\ArtisanController::class,'seed']);
Route::get('storage',[\App\Http\Controllers\ArtisanController::class,'storage']);
Route::get('cache',[\App\Http\Controllers\ArtisanController::class,'cache']);
