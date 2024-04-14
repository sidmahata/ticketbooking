<?php
namespace App\Services;

use App\Contracts\DistanceCalculator;
use App\Models\Distance;
use App\Models\Station;

class DistanceService{
    private $shortestDistance;

    public function __construct(
        private Station $fromStation,
        private Station $toStation,
        private DistanceCalculator $distanceCalculator,
    ) {
        $stations = Station::all();
        $stations->each(function(Station $station) use($distanceCalculator){
            $distanceCalculator->addVertex($station->id);
        });
        $distances = Distance::all();
        $distances->each(function(Distance $distance) use($distanceCalculator){
            $distanceCalculator->addEdge($distance->from_station_id, $distance->to_station_id, $distance->distance);
        });

        $source = $fromStation->id;
        $distances = $distanceCalculator->getDistances($source);

        $this->shortestDistance = $distances[$toStation->id];
    }
    public function getShortestDistance(){
        return $this->shortestDistance;
    }
}