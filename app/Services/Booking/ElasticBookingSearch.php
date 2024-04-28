<?php
namespace App\Services\Booking;

use App\Contracts\BookingSearch;
use App\Models\Booking;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\Response\Elasticsearch;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class ElasticBookingSearch implements BookingSearch{

    public function __construct(
        private Client $client
    ) {
        
    }
    public function search(string $text = ''): Collection
    {
        $items = $this->searchOnElasticsearch($text);
        return $this->buildCollection($items);        
    }

    private function searchOnElasticsearch(string $text = ''): Elasticsearch
    {
        $model = new Booking;
        $items = $this->client->search([
            'index' => $model->getElasticsearchIndexName(),
            'type' => '_doc',
            'body' => [
                'query' => [
                    'multi_match' => [
                        'fields' => ['client_name', 'from_station', 'to_station'],
                        'query' => $text,
                        'fuzziness' => 'AUTO'
                    ],
                ],
            ],
        ]);
        return $items;
    }
    private function buildCollection(Elasticsearch $items): Collection
    {
        $ids = Arr::pluck($items['hits']['hits'], '_id');
        return Booking::findMany($ids)
            ->sortBy(function ($row) use ($ids) {
                return array_search($row->getKey(), $ids);
            });
    }
}