<?php

namespace Database\Seeders;

use App\Models\Distance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DistanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Distance::factory()->count(64)->create();
    }
}
