<?php
namespace App\Services;

use App\Contracts\DistanceCalculator;
use SplPriorityQueue;

class DijkstraDistanceCalculator implements DistanceCalculator {
    private $vertices;
    private $edges;

    public function __construct() {
        $this->vertices = [];
        $this->edges = [];
    }

    public function addVertex($vertex) {
        $this->vertices[$vertex] = [];
    }
    public function getVertices() {
        return $this->vertices;
    }

    public function addEdge($source, $destination, $weight) {
        $this->edges[$source][$destination] = $weight;
        $this->edges[$destination][$source] = $weight; // for undirected graph
    }

    public function getDistances($source) {
        $distances = [];
        $visited = [];
        $pq = new SplPriorityQueue();

        foreach ($this->vertices as $vertex => $adj) {
            $distances[$vertex] = INF;
            $visited[$vertex] = false;
        }

        $distances[$source] = 0;
        $pq->insert($source, 0);

        while (!$pq->isEmpty()) {
            $current = $pq->extract();

            if ($visited[$current]) continue;

            $visited[$current] = true;

            foreach ($this->edges[$current] as $neighbor => $weight) {
                $alt = $distances[$current] + $weight;
                if ($alt < $distances[$neighbor]) {
                    $distances[$neighbor] = $alt;
                    $pq->insert($neighbor, -$alt);
                }
            }
        }

        return $distances;
    }
}