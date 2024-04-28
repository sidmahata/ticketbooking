<?php
namespace App\Services\Booking;

use App\Contracts\BookingSearch;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Collection;

class EloquentBookingSearch implements BookingSearch{

    public function __construct(
        
    ) {
        
    }
    public function search(string $text = ''): Collection
    {
        return Booking::with(['fromStation', 'toStation'])
                ->where('client_name', 'like', '%'.$text.'%')
                ->orWhereHas('fromStation', function($q) use($text){
                    $q->where('name', 'like', '%'.$text.'%');
                })
                ->orWhereHas('toStation', function($q) use($text){
                    $q->where('name', 'like', '%'.$text.'%');
                })
                ->orderBy('id', 'desc')->get();
    }
}