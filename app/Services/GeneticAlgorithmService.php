<?php

namespace App\Services;

use App\Models\Event;
use Illuminate\Support\Facades\DB;

class GeneticAlgorithmService
{
    public function runGeneticAlgorithm()
    {
        // Inisialisasi populasi, evaluasi, seleksi, crossover, mutasi, dll.
        // Implementasikan algoritma genetika sesuai dengan kebutuhan proyek Anda.

        $populationSize = 50;
        $generations = 100;
        $crossoverRate = 0.8;
        $mutationRate = 0.1;

        // Inisialisasi populasi
        $population = $this->initializePopulation($populationSize);

        for ($generation = 0; $generation < $generations; $generation++) {
            // Evaluasi populasi
            $fitnessValues = $this->evaluatePopulation($population);

            // Seleksi
            $selectedIndividuals = $this->selection($population, $fitnessValues);

            // Crossover
            $offspring = $this->crossover($selectedIndividuals, $crossoverRate);

            // Mutasi
            $mutatedOffspring = $this->mutation($offspring, $mutationRate);

            // Pembentukan populasi baru
            $population = $mutatedOffspring;
        }

        // Ambil solusi terbaik
        $bestSolution = $this->getBestSolution($population);

        return $bestSolution;
    }

    private function initializePopulation($size)
    {
        $population = [];
        for ($i = 0; $i < $size; $i++) {
            $individual = Event::inRandomOrder()->take(10)->get();
            $population[] = $individual;
        }
        return $population;
    }

    private function evaluatePopulation($population)
    {
        $fitnessValues = [];
        foreach ($population as $individual) {
            $fitnessValues[] = $this->evaluateIndividual($individual);
        }
        return $fitnessValues;
    }

    private function evaluateIndividual($individual)
    {
        // Evaluasi kebugaran individu berdasarkan kriteria tertentu
        // Contoh sederhana: total durasi event
        $fitness = 0;
        foreach ($individual as $event) {
            $start = strtotime($event->start_date);
            $end = strtotime($event->end_date);
            $fitness += ($end - $start);
        }
        return $fitness;
    }

    private function selection($population, $fitnessValues)
    {
        // Seleksi berdasarkan nilai kebugaran (fitness)
        // Implementasi seleksi sederhana: pilih individu terbaik
        $selected = [];
        arsort($fitnessValues);
        foreach ($fitnessValues as $key => $value) {
            $selected[] = $population[$key];
        }
        return $selected;
    }

    private function crossover($selectedIndividuals, $crossoverRate)
    {
        // Implementasi crossover
        $offspring = [];
        for ($i = 0; $i < count($selectedIndividuals); $i += 2) {
            if (rand(0, 100) / 100 <= $crossoverRate) {
                $parent1 = $selectedIndividuals[$i];
                $parent2 = $selectedIndividuals[$i + 1];
                $child1 = array_merge(array_slice($parent1, 0, count($parent1) / 2), array_slice($parent2, count($parent2) / 2));
                $child2 = array_merge(array_slice($parent2, 0, count($parent2) / 2), array_slice($parent1, count($parent1) / 2));
                $offspring[] = $child1;
                $offspring[] = $child2;
            } else {
                $offspring[] = $selectedIndividuals[$i];
                $offspring[] = $selectedIndividuals[$i + 1];
            }
        }
        return $offspring;
    }

    private function mutation($offspring, $mutationRate)
    {
        // Implementasi mutasi
        foreach ($offspring as &$individual) {
            if (rand(0, 100) / 100 <= $mutationRate) {
                $index = array_rand($individual);
                $individual[$index] = Event::inRandomOrder()->first();
            }
        }
        return $offspring;
    }

    private function getBestSolution($population)
    {
        // Ambil solusi terbaik dari populasi
        $bestSolution = null;
        $bestFitness = PHP_INT_MAX;
        foreach ($population as $individual) {
            $fitness = $this->evaluateIndividual($individual);
            if ($fitness < $bestFitness) {
                $bestFitness = $fitness;
                $bestSolution = $individual;
            }
        }
        return $bestSolution;
    }
}
