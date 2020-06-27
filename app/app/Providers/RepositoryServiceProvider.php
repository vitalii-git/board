<?php

namespace App\Providers;

use App\Interfaces\Repositories\BoardRepositoryInterface;
use App\Interfaces\Repositories\StatusRepositoryInterface;
use App\Interfaces\Repositories\TaskRepositoryInterface;
use App\Repositories\BoardRepository;
use App\Repositories\StatusRepository;
use App\Repositories\TaskRepository;
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

        $this->app->bind(
            TaskRepositoryInterface::class,
            TaskRepository::class
        );

        $this->app->bind(
            StatusRepositoryInterface::class,
            StatusRepository::class
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
