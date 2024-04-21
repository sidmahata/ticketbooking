<?php

namespace App\Contracts;

use Illuminate\Contracts\Database\Eloquent\Builder;

interface Report
{
    public function download(Builder $queryBuilder, String $title='Report', array $meta=[], array $columns=[], String $fileName='Report', String $type='pdf');
}
