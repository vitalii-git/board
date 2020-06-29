<?php

namespace App\Providers;

use App\Board;
use App\Image;
use App\Label;
use App\Policies\BoardPolicy;
use App\Policies\ImagePolicy;
use App\Policies\LabelPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Board::class => BoardPolicy::class,
        Image::class => ImagePolicy::class,
        Label::class => LabelPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
        Passport::loadKeysFrom(storage_path());
    }
}
