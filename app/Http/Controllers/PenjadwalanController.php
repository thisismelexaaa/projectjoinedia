<?php

namespace App\Http\Controllers;

use App\Models\Penjadwalan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PenjadwalanController extends Controller
{
    public function index()
    {
        $jadwal = Penjadwalan::with('buat_events')
            ->get()
            ->map(function ($item) {
                $sponsorLevel = $item->level;

                if ($sponsorLevel === 'universitas') {
                    $color = '#0d6efd'; // Hijau
                } elseif ($sponsorLevel === 'fakultas') {
                    $color = '#6610f2'; // Kuning
                } elseif ($sponsorLevel === 'prodi') {
                    $color = '#ffc107'; // Kuning
                } elseif ($sponsorLevel === 'hima') {
                    $color = '#fd7e14'; // Merah
                } elseif ($sponsorLevel === 'ukm') {
                    $color = '#e74c3c'; // Merah
                } else {
                    $color = '#34495e'; // Abu-abu (misalnya untuk "lainnya")
                }
                return [
                    'id' => $item->id,
                    'title' => $item->buat_events->nama,
                    'start' => $item->buat_events->start_date,
                    'end' => $item->buat_events->end_date,
                    'url' => route('event.show', $item->buat_events->id),
                    'backgroundColor' => $color,
                ];
            })
            ->all();

        return view('page.penjadwalan.index', compact('jadwal'));
    }

    public function OptimalasisaData(Request $request): JsonResponse
    {
        // Mendekode data jadwal dari input tersembunyi
        $jadwal = json_decode($request->input('jadwal'), true);

        // count jadwal
        $countJadwal = count($jadwal);

        // Parameter genetika
        $populationSize = $countJadwal;
        $generations = $countJadwal * 10;
        $mutationRate = $countJadwal / 1000;

        // Inisialisasi populasi
        $population = $this->initializePopulation($populationSize, $jadwal);
        dd($population);

        for ($i = 0; $i < $generations; $i++) {
            // Evaluasi populasi
            $population = $this->evaluatePopulation($population);

            // Seleksi dan reproduksi
            $newPopulation = [];
            for ($j = 0; $j < $populationSize / 2; $j++) {
                $parent1 = $this->select($population);
                $parent2 = $this->select($population);
                $offspring = $this->crossover($parent1, $parent2);

                // Mutasi
                if (rand() / getrandmax() < $mutationRate) {
                    $offspring[0] = $this->mutate($offspring[0]);
                }
                if (rand() / getrandmax() < $mutationRate) {
                    $offspring[1] = $this->mutate($offspring[1]);
                }

                $newPopulation[] = $offspring[0];
                $newPopulation[] = $offspring[1];
            }

            $population = $newPopulation;
        }

        // Jadwal terbaik
        $bestSchedule = $this->getBestSchedule($population);

        // Kembalikan hasil optimasi
        return response()->json([
            'status' => 'success',
            'message' => 'Jadwal berhasil dioptimasi!',
            'data' => $bestSchedule,
        ]);
    }

    private function initializePopulation($populationSize, $jadwal)
    {
        $population = [];
        for ($i = 0; $i < $populationSize; $i++) {
            // Buat salinan jadwal awal dan acak urutannya
            $individual = $jadwal;
            shuffle($individual);
            $population[] = $individual;
        }
        return $population;
    }

    private function evaluatePopulation($population)
    {
        // Evaluasi fitness setiap individu dalam populasi
        foreach ($population as &$individual) {
            $individual['fitness'] = $this->calculateFitness($individual);
        }
        return $population;
    }

    private function calculateFitness($individual)
    {
        $fitness = 0;
        // Hitung jumlah konflik dalam jadwal
        foreach ($individual as $event) {
            foreach ($individual as $otherEvent) {
                if ($event['id'] !== $otherEvent['id'] && $this->isConflict($event, $otherEvent)) {
                    $fitness--;
                }
            }
        }
        return $fitness;
    }

    private function isConflict($event1, $event2)
    {
        return ($event1['start'] < $event2['end'] && $event1['end'] > $event2['start']);
    }

    private function select($population)
    {
        // Seleksi berdasarkan roulette wheel selection
        $totalFitness = array_sum(array_column($population, 'fitness'));
        $random = rand() / getrandmax() * $totalFitness;
        $current = 0;
        foreach ($population as $individual) {
            $current += $individual['fitness'];
            if ($current >= $random) {
                return $individual;
            }
        }
        return $population[0];
    }

    private function crossover($parent1, $parent2)
    {
        // Single point crossover
        $crossoverPoint = rand(0, count($parent1));
        $offspring1 = array_merge(array_slice($parent1, 0, $crossoverPoint), array_slice($parent2, $crossoverPoint));
        $offspring2 = array_merge(array_slice($parent2, 0, $crossoverPoint), array_slice($parent1, $crossoverPoint));
        return [$offspring1, $offspring2];
    }

    private function mutate($individual)
    {
        // Swap mutasi sederhana
        $index1 = array_rand($individual);
        $index2 = array_rand($individual);
        $temp = $individual[$index1];
        $individual[$index1] = $individual[$index2];
        $individual[$index2] = $temp;
        return $individual;
    }

    private function getBestSchedule($population)
    {
        // Kembalikan individu dengan fitness terbaik
        usort($population, function ($a, $b) {
            return $b['fitness'] - $a['fitness'];
        });
        return $population[0];
    }
}
