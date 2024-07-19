<?php

namespace App\Http\Services;

use App\Models\Event;

class AlgoritmaGenetikaService
{
    public function initializePopulation($populationSize, $events)
    {
        $population = [];

        for ($i = 0; $i < $populationSize; $i++) {
            $individual = $this->generateRandomEvent($events);
            $population[] = $individual;
        }

        return $population;
    }

    private function generateRandomEvent($events)
    {
        shuffle($events);
        return $events;
    }

    public function calculateFitness($individual)
    {
        $fitness = 0;
        $totalEvents = count($individual);

        for ($i = 0; $i < $totalEvents; $i++) {
            for ($j = $i + 1; $j < $totalEvents; $j++) {
                if ($this->isConflict($individual[$i], $individual[$j])) {
                    $fitness -= 1; // Penalti untuk konflik waktu
                }
            }
        }

        return $fitness;
    }

    private function isConflict($event1, $event2)
    {
        return !(
            strtotime($event1['end_date']) <= strtotime($event2['start_date']) ||
            strtotime($event2['end_date']) <= strtotime($event1['start_date'])
        );
    }

    public function selection($population)
    {
        usort($population, function ($a, $b) {
            return $this->calculateFitness($b) <=> $this->calculateFitness($a);
        });

        return $population[0];
    }

    public function crossover($parent1, $parent2)
    {
        $crossoverPoint = rand(0, count($parent1) - 1);
        $child = array_merge(
            array_slice($parent1, 0, $crossoverPoint),
            array_slice($parent2, $crossoverPoint)
        );

        return $child;
    }

    public function mutation($individual)
    {
        if (rand(0, 100) < 5) {
            $mutationPoint = array_rand($individual);
            $individual[$mutationPoint] = Event::inRandomOrder()->first()->toArray();
        }

        return $individual;
    }
}
