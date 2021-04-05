<?php

namespace App\Providers;

use App\Models\Client;
use App\Models\User;
use App\Repositories\ClientEloquentRepository;
use App\Repositories\ClientRepositoryInterface;
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
