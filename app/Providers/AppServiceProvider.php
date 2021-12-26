<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        View::composer(['admin.layouts.partials.sidebar'],\App\Http\Views\Composers\RequestForApprovalComposer::class);
        if (request()->is('api*'))
        {
            $this->app->setLocale('en');
        }
    }
}
