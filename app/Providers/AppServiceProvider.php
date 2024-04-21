<?php

namespace App\Providers;

use App\Contracts\DistanceCalculator;
use App\Contracts\Report;
use App\Services\DijkstraDistanceCalculator;
use App\Services\ReportGenerator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(DistanceCalculator::class, DijkstraDistanceCalculator::class);
        $this->app->bind(Report::class, ReportGenerator::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
