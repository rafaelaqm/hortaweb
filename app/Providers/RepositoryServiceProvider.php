<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Repositories\UserRepository::class, \App\Repositories\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\InstitutionRepository::class, \App\Repositories\InstitutionRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\GroupRepository::class, \App\Repositories\GroupRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PlantRepository::class, \App\Repositories\PlantRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\MovimentRepository::class, \App\Repositories\MovimentRepositoryEloquent::class);
        //:end-bindings:
    }
}
