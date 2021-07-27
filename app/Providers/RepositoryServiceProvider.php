<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\MisaRepository::class, \App\Repositories\MisaRepositoryEloquent::class);
        $this->app->bind(
            \App\Repositories\Interfaces\TestRepository::class,
             \App\Repositories\TestRepositoryEloquent::class
            );
        $this->app->bind(\App\Repositories\Interfaces\TestRepository::class, \App\Repositories\TestRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\InformationRepository::class, \App\Repositories\InformationRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\ContactRepository::class, \App\Repositories\ContactRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\ExperienceUserRepository::class, \App\Repositories\ExperienceUserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\CompetenceUserRepository::class, \App\Repositories\CompetenceUserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\PostUserRepository::class, \App\Repositories\PostUserRepositoryEloquent::class);
        //:end-bindings:
    }
}
