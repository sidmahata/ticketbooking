<?php

namespace Database\Factories;

use App\Models\Station;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Distance>
 */
class DistanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $stations = Station::all();
        $fromRand = random_int(0, count($stations)-1);
        do {
            $toRand = random_int(0, count($stations)-1);
        } while($fromRand==$toRand);

        return [
            'distance' => fake()->numberBetween(0, 100),
            'from_station_id'=>$stations[$fromRand]->id,
            'to_station_id'=>$stations[$toRand]->id,
        ];
    }
}
