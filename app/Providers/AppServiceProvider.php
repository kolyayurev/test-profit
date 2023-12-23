<?php

namespace App\Providers;

use App\Repositories\PostRepository;
use App\Repositories\PostRepositoryContract;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(PostRepositoryContract::class, PostRepository::class);
    }
}
