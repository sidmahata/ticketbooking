<?php

namespace App\Models;

use App\Search\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory, Searchable;

    public function fromStation(): BelongsTo
    {
        return $this->belongsTo(Station::class, 'from_station_id');
    }
    public function toStation(): BelongsTo
    {
        return $this->belongsTo(Station::class, 'to_station_id');
    }

    public function toElasticsearchDocumentArray(): array
    {
        return [
            'client_name' => $this->client_name,
            'from_station' => $this->fromStation->name,
            'to_station' => $this->toStation->name,
        ];
    }
    public function getElasticsearchIndexName(): string
    {
        return tenant('id').'_'.$this->getTable();
    }
    public function getElasticsearchId(): string
    {
        return $this->getKey();
    }
}
