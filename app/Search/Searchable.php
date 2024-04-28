<?php

namespace App\Search;

use Elastic\Elasticsearch\Client;

trait Searchable
{
    public static function bootSearchable()
    {
        if (config('services.search.enabled')) {
            static::observe(ElasticsearchObserver::class);
        }
    }

    public function elasticsearchIndex(Client $elasticsearchClient)
    {
        $elasticsearchClient->index([
            'index' => $this->getElasticsearchIndexName(),
            'type' => '_doc',
            'id' => $this->getElasticsearchId(),
            'body' => $this->toElasticsearchDocumentArray(),
        ]);
    }

    public function elasticsearchDelete(Client $elasticsearchClient)
    {
        $elasticsearchClient->delete([
            'index' => $this->getElasticsearchIndexName(),
            'type' => '_doc',
            'id' => $this->getKey(),
        ]);
    }

    abstract public function toElasticsearchDocumentArray(): array;
    abstract public function getElasticsearchIndexName(): string;
    abstract public function getElasticsearchId(): string;
}