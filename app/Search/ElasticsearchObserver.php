<?php

namespace App\Search;

use Elastic\Elasticsearch\Client;

class ElasticsearchObserver
{
    public function __construct(private Client $client)
    {
        // ...
    }

    public function saved($model)
    {
        $model->elasticSearchIndex($this->client);
    }

    public function deleted($model)
    {
        $model->elasticSearchDelete($this->client);
    }
}