<?php

namespace App\Http\Controllers;

use App\Models\BuatEvent;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GeneticAlgorithmController extends Controller
{
    public function generateSchedule()
    {
        // Ambil data event yang aktif dari database
        $events = BuatEvent::where('status', 'aktif')->orderBy('hari')->get()->toArray();

        // Pastikan ada data sebelum melanjutkan
        if (empty($events)) {
            return redirect()->back()->with('error', 'No active events found.');
        }

        // Hasilkan jadwal optimal menggunakan algoritma genetika
        $optimalSchedule = $this->geneticAlgorithm($events, 20, 150); // Ukuran populasi 20 dan 150 generasi


        // Simpan jadwal yang dihasilkan ke dalam session
        session(['generated_schedule' => $optimalSchedule]);

        return back();
    }

    private function geneticAlgorithm($events, $populationSize, $generations)
    {
        // Inisialisasi populasi awal
        $population = $this->initializePopulation($events, $populationSize);

        for ($i = 0; $i < $generations; $i++) {
            // Pilih orang tua untuk crossover
            $parents = $this->selectParents($population);
            $newPopulation = [];

            for ($j = 0; $j < $populationSize / 2; $j++) {
                // Buat anak-anak melalui crossover
                $offspring = $this->crossover($parents[0], $parents[1]);
                $newPopulation[] = $this->mutate($offspring[0]);
                $newPopulation[] = $this->mutate($offspring[1]);
            }

            // Update populasi dengan generasi baru
            $population = $newPopulation;
        }

        // Urutkan populasi berdasarkan fitness dan pilih individu terbaik
        usort($population, function ($a, $b) {
            return $this->fitnessFunction($b) <=> $this->fitnessFunction($a);
        });

        // Pilih event yang unik dari jadwal terbaik
        return $this->selectUniqueEvents($population[0]);
    }

    private function initializePopulation($events, $populationSize)
    {
        $population = [];
        for ($i = 0; $i < $populationSize; $i++) {
            $shuffledEvents = $events;
            shuffle($shuffledEvents);
            $population[] = $shuffledEvents;
        }
        return $population;
    }

    private function fitnessFunction($events)
    {
        $conflicts = $this->calculateConflicts($events);
        // Mengembalikan nilai fitness, lebih banyak konflik berarti fitness lebih rendah
        return 1 / (count($conflicts) + 1);
    }

    private function selectParents($population)
    {
        usort($population, function ($a, $b) {
            return $this->fitnessFunction($b) <=> $this->fitnessFunction($a);
        });

        return array_slice($population, 0, 2); // Pilih 2 individu terbaik
    }

    private function crossover($parent1, $parent2)
    {
        $crossoverPoint = rand(1, count($parent1) - 1);
        $child1 = array_merge(array_slice($parent1, 0, $crossoverPoint), array_slice($parent2, $crossoverPoint));
        $child2 = array_merge(array_slice($parent2, 0, $crossoverPoint), array_slice($parent1, $crossoverPoint));
        return [$child1, $child2];
    }

    private function mutate($individual)
    {
        $index1 = rand(0, count($individual) - 1);
        $index2 = rand(0, count($individual) - 1);

        // Swap elements at index1 and index2
        $temp = $individual[$index1];
        $individual[$index1] = $individual[$index2];
        $individual[$index2] = $temp;

        return $individual;
    }

    private function calculateConflicts($events)
    {
        $conflicts = [];
        $n = count($events);

        // Bandingkan setiap pasangan event untuk mendeteksi konflik
        for ($i = 0; $i < $n; $i++) {
            for ($j = $i + 1; $j < $n; $j++) {
                $event1 = $events[$i];
                $event2 = $events[$j];

                // Periksa apakah event1 dan event2 bertabrakan
                if ($this->eventsOverlap($event1, $event2)) {
                    $conflicts[] = [
                        'event1' => $event1['id'],
                        'event2' => $event2['id']
                    ];
                }
            }
        }

        return $conflicts;
    }

    private function eventsOverlap($event1, $event2)
    {
        // Convert start and end dates to Carbon instances for comparison
        $start1 = Carbon::parse($event1['start_date']);
        $end1 = Carbon::parse($event1['end_date']);
        $start2 = Carbon::parse($event2['start_date']);
        $end2 = Carbon::parse($event2['end_date']);

        // Check if events overlap
        return $start1->lessThanOrEqualTo($end2) && $end1->greaterThanOrEqualTo($start2);
    }

    private function selectUniqueEvents($events)
    {
        $seen = [];
        $uniqueEvents = [];
        foreach ($events as $event) {
            if (!in_array($event['id'], $seen)) {
                $seen[] = $event['id'];
                $uniqueEvents[] = $event;
            }
        }
        return $uniqueEvents;
    }

    public function index()
    {
        $events = session('generated_schedule', []);
        $currentDate = Carbon::now();

        foreach ($events as &$event) {
            // Tentukan durasi event berdasarkan nilai 'hari'
            $eventDuration = $event['hari'];

            // Tentukan tanggal mulai (start_date) sesuai dengan tanggal sekarang atau tanggal setelah event sebelumnya
            $event['start_date'] = $currentDate->format('Y-m-d');

            // Tentukan tanggal selesai (end_date) dengan menambah durasi hari
            $event['end_date'] = $currentDate->copy()->addDays($eventDuration - 1)->format('Y-m-d');

            // Update tanggal sekarang ke tanggal setelah event ini selesai
            $currentDate->addDays($eventDuration);
        }

        session(['updated_schedule' => $events]);

        return view('page.MakeSchedule.index', ['events' => $events]);
    }

    public function updateSchedule(Request $request)
    {
        $validated = $request->validate([
            'events.*.id' => 'required|integer|exists:events,id',
            'events.*.start_date' => 'required|date',
            'events.*.end_date' => 'required|date|after_or_equal:events.*.start_date',
        ]);

        foreach ($validated['events'] as $eventData) {
            Event::where('id', $eventData['id'])
                ->update([
                    'start_date' => $eventData['start_date'],
                    'end_date' => $eventData['end_date']
                ]);
        }

        return redirect()->back()->with('success', 'Schedule updated successfully!');
    }
}
