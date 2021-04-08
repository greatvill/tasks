<?php

namespace App\Providers;

use App\Models\Client;
use App\Models\User;
use App\Repositories\ClientEloquentRepository;
use App\Repositories\ClientRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use App\Services\UserService;
use Illuminate\Database\Eloquent\Relations\Relation;
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
        $this->app->bind(ClientRepositoryInterface::class, function ($app) {
            return new ClientEloquentRepository();
        });
        $this->app->bind(UserRepositoryInterface::class, function () {
            return new UserRepository();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'user' => User::class,
            'client' => Client::class,
        ]);
    }
}
