<?php

namespace App\Providers;

use App\Contracts\DistanceCalculator;
use App\Services\DijkstraDistanceCalculator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(DistanceCalculator::class, DijkstraDistanceCalculator::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
