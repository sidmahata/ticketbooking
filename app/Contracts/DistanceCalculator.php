<?php

namespace App\Contracts;

interface DistanceCalculator
{
    public function addVertex($vertex);
    public function addEdge($source, $destination, $weight);
    public function getDistances($source);
}
