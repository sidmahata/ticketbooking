<?php
namespace App\Services;

use App\Contracts\DistanceCalculator;
use App\Models\Booking;
use App\Models\Distance;
use App\Models\Station;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class NewBookingService{
    
    private Collection $stations;
    private Station $fromStation;
    private Station $toStation;
    private int $shortestDistance;
    private Booking $booking;

    public function __construct(private Request $request, private DistanceCalculator $distanceCalculator) {
        $this->fromStation = Station::whereId($request->from_station)->first();
        $this->toStation = Station::whereId($request->to_station)->first();
        $this->stations = Station::all();
        $this->booking = new Booking();

        $this->calculateShortestDistance();
    }
    private function calculateShortestDistance(){
        $distanceCalculator = $this->distanceCalculator;
        
        $this->stations->each(function(Station $station) use($distanceCalculator){
            $distanceCalculator->addVertex($station->id);
        });
        $distances = Distance::all();
        $distances->each(function(Distance $distance) use($distanceCalculator){
            $distanceCalculator->addEdge($distance->from_station_id, $distance->to_station_id, $distance->distance);
        });

        $distances = $this->distanceCalculator->getDistances($this->fromStation->id);
        $this->shortestDistance = $distances[$this->toStation->id];
        // dd($this->shortestDistance);
    }
    public function create(){        
        $this->booking->client_name = $this->request->client_name;
        $this->booking->fromStation()->associate($this->fromStation);
        $this->booking->toStation()->associate($this->toStation);
        $this->booking->total_distance = $this->shortestDistance;
        $this->booking->total_fare = $this->shortestDistance*5;    
        $this->booking->save();
    }
    public function getNewBooking(){
        return $this->booking;
    }
    
}