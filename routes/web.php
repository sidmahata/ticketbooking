<?php

use Elastic\Elasticsearch\Client;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
        Route::get('/', function () {
            return 'This is your central route';
        });

        /*Route::get('/testelastic', function(Client $client){
            $items = ($client->search([
                'index' => 'books',
                'type' => '_doc',
                'body' => [
                    'query' => [
                        'multi_match' => [
                            // 'fields' => ['name'],
                            'query' => 'Crash',
                        ],
                    ],
                ],
            ]));
            $ids = Arr::pluck($items['hits']['hits'], '_id');
            dd($ids);
        })->name('test');*/
    });    
}


