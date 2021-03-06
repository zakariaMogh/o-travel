<?php


use Illuminate\Support\Facades\Route;


Route::post('register',[\App\Http\Controllers\Api\User\Auth\RegisterController::class,'register'])->name('register');
Route::post('socialite/login',[\App\Http\Controllers\Api\User\Auth\SocialiteLogin::class,'socialiteLogin'])->name('socialite.login');
Route::post('login',[\App\Http\Controllers\Api\User\Auth\AuthController::class,'login'])->name('login');

Route::get('privacy_policy',[\App\Http\Controllers\Api\SettingsController::class,'privacy_policy'])->name('privacy_policy');
Route::get('about_us',[\App\Http\Controllers\Api\SettingsController::class,'about_us'])->name('about_us');
Route::get('terms_of_use',[\App\Http\Controllers\Api\SettingsController::class,'terms_of_use'])->name('terms_of_use');

Route::middleware('auth:user')->group(function (){
    Route::get('me',[\App\Http\Controllers\Api\User\Auth\AuthController::class,'me'])->name('me');
    Route::post('logout',[\App\Http\Controllers\Api\User\Auth\AuthController::class,'logout'])->name('logout');
    Route::post('upload/image',[\App\Http\Controllers\Api\User\Auth\AuthController::class,'updateImage'])->name('upload.image');
    Route::put('update',[\App\Http\Controllers\Api\User\Auth\AuthController::class,'update'])->name('update');

    Route::post('offers/{id}/favorite',[\App\Http\Controllers\Api\User\OfferController::class,'markAsFavorite'])->name('offers.favorite.store');
    Route::post('reports', \App\Http\Controllers\Api\User\ReportController::class);

    Route::get('notifications/count',[App\Http\Controllers\Api\User\NotificationController::class, 'count']);
    Route::resource('notifications',App\Http\Controllers\Api\User\NotificationController::class)->only(['index', 'destroy']);

});

Route::get('companies',[\App\Http\Controllers\Api\User\CompanyController::class,'index'])->name('companies.index');
Route::get('companies/{id}',[\App\Http\Controllers\Api\User\CompanyController::class,'show'])->name('companies.show');

Route::resource('offers', \App\Http\Controllers\Api\User\OfferController::class)->only(['show', 'index']);

Route::get('stories/company',[\App\Http\Controllers\Api\User\StoryController::class, 'getStoriesByCompany']);
Route::get('stories',[\App\Http\Controllers\Api\User\StoryController::class, 'index'])->name('stories.index');

Route::get('countries',\App\Http\Controllers\Api\User\CountryController::class)->name('countries.index');
Route::get('categories',\App\Http\Controllers\Api\User\CategoryController::class)->name('categories.index');

Route::get('domains',\App\Http\Controllers\Api\User\DomainController::class)->name('domains.index');
Route::get('cities',\App\Http\Controllers\Api\User\CityController::class)->name('cities.index');
