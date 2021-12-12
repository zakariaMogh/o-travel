<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repos = [
        \App\Contracts\ImageContract::class     => \App\Repositories\ImageRepository::class,
        \App\Contracts\CommentContract::class   => \App\Repositories\CommentRepository::class,
        \App\Contracts\CompanyContract::class   => \App\Repositories\CompanyRepository::class,
        \App\Contracts\OfferContract::class     => \App\Repositories\OfferRepository::class,
        \App\Contracts\CountryContract::class   => \App\Repositories\CountryRepository::class,
        \App\Contracts\UserContract::class      => \App\Repositories\UserRepository::class,
        \App\Contracts\DomainContract::class    => \App\Repositories\DomainRepository::class,
        \App\Contracts\CityContract::class      => \App\Repositories\CityRepository::class,
        \App\Contracts\CategoryContract::class  => \App\Repositories\CategoryRepository::class,
        \App\Contracts\AdminContract::class     => \App\Repositories\AdminRepository::class,
        \App\Contracts\ReportContract::class    => \App\Repositories\ReportRepository::class,
        \App\Contracts\StoryContract::class    => \App\Repositories\StoryRepository::class,
        \App\Contracts\NotificationContract::class    => \App\Repositories\NotificationRepository::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        foreach ($this->repos as $abstract => $concrete) {
            $this->app->singleton($abstract, $concrete);
        }
    }
}
