<?php

namespace App\Http\Controllers;

use App\Http\Services\AlgoritmaGenetikaService;
use App\Models\Event;
use App\Services\GeneticAlgorithmService;
use Illuminate\Http\Request;

class AlgoritmaGeneticController extends Controller
{
    protected $geneticAlgorithmService;

    public function __construct(AlgoritmaGenetikaService $geneticAlgorithmService)
    {
        $this->geneticAlgorithmService = $geneticAlgorithmService;
    }

    public function index(Request $request)
    {
        $query = Event::query();

        if ($request->has('start_date') && $request->start_date) {
            $query->where('start_date', '>=', $request->start_date);
        }

        if ($request->has('end_date') && $request->end_date) {
            $query->where('end_date', '<=', $request->end_date);
        }

        if ($request->has('location') && $request->location) {
            $query->where('location', $request->location);
        }

        $events = $query->get()->toArray();

        mt_srand(123);
        shuffle($events);

        $populationSize = 10;
        $generations = 100;

        $population = $this->geneticAlgorithmService->initializePopulation($populationSize, $events);

        for ($i = 0; $i < $generations; $i++) {
            $newPopulation = [];

            foreach ($population as $individual) {
                $fitness = $this->geneticAlgorithmService->calculateFitness($individual);

                $parent1 = $this->geneticAlgorithmService->selection($population);
                $parent2 = $this->geneticAlgorithmService->selection($population);

                $child = $this->geneticAlgorithmService->crossover($parent1, $parent2);
                $mutatedChild = $this->geneticAlgorithmService->mutation($child);

                $newPopulation[] = $mutatedChild;
            }

            $population = $newPopulation;
        }

        $bestIndividual = $this->getBestIndividual($population);

        return view("test-algoritma", ['bestIndividual' => $bestIndividual, 'filters' => $request->all()]);
    }

    private function getBestIndividual($population)
    {
        $bestIndividual = null;
        $bestFitness = -PHP_INT_MAX;

        foreach ($population as $individual) {
            $fitness = $this->geneticAlgorithmService->calculateFitness($individual);
            if ($fitness > $bestFitness) {
                $bestFitness = $fitness;
                $bestIndividual = $individual;
            }
        }

        return $bestIndividual;
    }
}
