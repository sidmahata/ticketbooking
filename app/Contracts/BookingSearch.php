<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface BookingSearch
{
    public function search(string $text): Collection;
}
