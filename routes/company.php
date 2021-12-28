<?php


use Illuminate\Support\Facades\Route;


Route::post('register',[\App\Http\Controllers\Api\Company\Auth\RegisterController::class,'register'])->name('register');
Route::post('login',[\App\Http\Controllers\Api\Company\Auth\CompanyLoginController::class,'login'])->name('login');

Route::get('privacy_policy',[\App\Http\Controllers\Api\SettingsController::class,'privacy_policy'])->name('privacy_policy');
Route::get('about_us',[\App\Http\Controllers\Api\SettingsController::class,'about_us'])->name('about_us');
Route::get('terms_of_use',[\App\Http\Controllers\Api\SettingsController::class,'terms_of_use'])->name('terms_of_use');


Route::middleware('auth:company')->group(function (){

    Route::get('companies/{id}',[\App\Http\Controllers\Api\User\CompanyController::class,'show'])->name('companies.show');
    Route::get('companies',[\App\Http\Controllers\Api\User\CompanyController::class,'index'])->name('companies.index');

    Route::get('me',[\App\Http\Controllers\Api\Company\Auth\CompanyLoginController::class,'me'])->name('name');
    Route::post('logout',[\App\Http\Controllers\Api\Company\Auth\CompanyLoginController::class,'logout'])->name('logout');
    Route::post('upload/image',[\App\Http\Controllers\Api\Company\Auth\CompanyLoginController::class,'uploadImage'])->name('upload.image');
    Route::put('update',[\App\Http\Controllers\Api\Company\Auth\CompanyLoginController::class,'update'])->name('update');


    Route::get('countries',\App\Http\Controllers\Api\Company\CountryController::class)->name('countries.index');
    Route::get('categories',\App\Http\Controllers\Api\Company\CategoryController::class)->name('categories.index');

    Route::post('offers/{id}/favorite',[\App\Http\Controllers\Api\Company\OfferController::class,'markAsFavorite'])->name('offers.favorite.store');
    Route::resource('offers',\App\Http\Controllers\Api\Company\OfferController::class)->only(['store','index','show','update','destroy']);

    Route::get('stories/company',[\App\Http\Controllers\Api\Company\StoryController::class, 'getStoriesByCompany']);
    Route::apiResource('stories',\App\Http\Controllers\Api\Company\StoryController::class);
    Route::post('reports', \App\Http\Controllers\Api\User\ReportController::class);

    Route::get('notifications/count',[App\Http\Controllers\Api\Company\NotificationController::class, 'count']);
    Route::resource('notifications',App\Http\Controllers\Api\Company\NotificationController::class)->only(['index', 'destroy']);
});

Route::get('domains',\App\Http\Controllers\Api\Company\DomainController::class)->name('domains.index');
Route::get('cities',\App\Http\Controllers\Api\Company\CityController::class)->name('cities.index');
