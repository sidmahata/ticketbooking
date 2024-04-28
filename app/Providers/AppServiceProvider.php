<?php

namespace App\Providers;

use App\Contracts\DistanceCalculator;
use App\Contracts\Report;
use App\Services\DijkstraDistanceCalculator;
use App\Services\ReportGenerator;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
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

        $this->app->bind(Client::class, function ($app) {
            return ClientBuilder::create()
                ->setHosts($app['config']->get('services.search.hosts'))
                // ->setSSLCert('~/elasticstack/elasticredmi1/config/certs/http_ca.crt')
                ->setSSLVerification(false)
                ->setBasicAuthentication(env('ELASTICSEARCH_USER'), env('ELASTICSEARCH_PASSWORD'))
                ->build();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
