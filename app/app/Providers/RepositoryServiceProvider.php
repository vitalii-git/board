<?php

namespace App\Providers;

use App\Interfaces\Repositories\BoardRepositoryInterface;
use App\Repositories\BoardRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            BoardRepositoryInterface::class,
            BoardRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
