<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BuatEvent;
use Carbon\Carbon;

class GeneticAlgorithmController extends Controller
{
    public function index(Request $request)
    {
        $scheduledEvents = []; // Inisialisasi variabel scheduledEvents sebagai array kosong
        $conflicts = []; // Inisialisasi variabel conflicts sebagai array kosong
        return view('page.MakeSchedule.index', compact('scheduledEvents', 'conflicts'));
    }

    public function generateSchedule(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $events = BuatEvent::where('status', 'aktif')->get();

        // Algoritma Genetika untuk Penjadwalan
        $scheduledEvents = $this->geneticAlgorithm($events, $bulan, $tahun);


        return view('page.MakeSchedule.index', compact('scheduledEvents', 'bulan', 'tahun'));
    }

    public function checkConflicts(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $events = BuatEvent::where('status', 'aktif')->get();
        $scheduledEvents = $this->geneticAlgorithm($events, $bulan, $tahun);

        // Pengecekan konflik
        $conflicts = $this->findConflicts($scheduledEvents);

        return view('page.MakeSchedule.index', compact('scheduledEvents', 'conflicts', 'bulan', 'tahun'));
    }

    private function geneticAlgorithm($events, $bulan, $tahun)
    {
        // Populasi awal
        $population = $this->generateInitialPopulation($events, $bulan, $tahun);

        // Iterasi untuk evolusi
        $iterations = max(10, min(100, count($events) * 10));
        for ($i = 0; $i < $iterations; $i++) {
            // Seleksi
            $selected = $this->selection($population);

            // Crossover
            $offspring = $this->crossover($selected);

            // Mutasi
            $mutated = $this->mutation($offspring, $bulan, $tahun);

            // Evaluasi
            $population = $this->evaluate($mutated, $events, $bulan, $tahun);
        }

        // Kembalikan individu terbaik tanpa duplikasi event
        return $this->removeDuplicateEvents($population);
    }


    private function generateInitialPopulation($events, $bulan, $tahun)
    {
        $population = [];
        $daysInMonth = Carbon::createFromDate($tahun, $bulan, 1)->daysInMonth;
        $availableDays = range(1, $daysInMonth);
        shuffle($availableDays);

        foreach ($events as $event) {
            do {
                $startDay = array_pop($availableDays);
            } while ($this->checkConflict($availableDays, $startDay, $event->hari));

            $population[] = [
                'event' => $event,
                'startDay' => $startDay,
                'endDay' => $startDay + $event->hari - 1
            ];
        }

        return $population;
    }


    private function checkConflict($usedDays, $startDay, $duration)
    {
        for ($i = 0; $i < $duration; $i++) {
            if (in_array($startDay + $i, $usedDays)) {
                return true;
            }
        }
        return false;
    }

    private function selection($population)
    {
        // Implementasi seleksi: pilih individu terbaik
        usort($population, function ($a, $b) {
            return $this->fitness($a) > $this->fitness($b);
        });

        return array_slice($population, 0, count($population) / 2);
    }

    private function crossover($selected)
    {
        // Implementasi crossover: lakukan persilangan antar individu
        $offspring = [];
        $count = count($selected);

        for ($i = 0; $i < $count; $i += 2) {
            if ($i + 1 < $count) {
                $parent1 = $selected[$i];
                $parent2 = $selected[$i + 1];

                $child1 = [
                    'event' => $parent1['event'],
                    'startDay' => $parent2['startDay'],
                    'endDay' => $parent2['endDay']
                ];

                $child2 = [
                    'event' => $parent2['event'],
                    'startDay' => $parent1['startDay'],
                    'endDay' => $parent1['endDay']
                ];

                $offspring[] = $child1;
                $offspring[] = $child2;
            }
        }

        return $offspring;
    }

    private function mutation($offspring, $bulan, $tahun)
    {
        // Implementasi mutasi: ubah startDay secara acak
        foreach ($offspring as &$individual) {
            if (rand(0, 100) < 5) { // 5% probabilitas mutasi
                $daysInMonth = Carbon::createFromDate($tahun, $bulan, 1)->daysInMonth;
                $individual['startDay'] = rand(1, $daysInMonth - $individual['event']->hari + 1);
                $individual['endDay'] = $individual['startDay'] + $individual['event']->hari - 1;
            }
        }

        return $offspring;
    }

    private function evaluate($mutated, $events, $bulan, $tahun)
    {
        // Evaluasi: gabungkan individu hasil mutasi ke populasi
        return array_merge($mutated, $this->generateInitialPopulation($events, $bulan, $tahun));
    }

    private function fitness($individual)
    {
        $conflicts = $this->findConflicts([$individual]);
        return 1 / (count($conflicts) + 1); // Prioritaskan event dengan konflik lebih sedikit
    }


    private function removeDuplicateEvents($population)
    {
        $uniqueEvents = [];
        $seenEventIds = [];

        foreach ($population as $individual) {
            if (!in_array($individual['event']->id, $seenEventIds)) {
                $uniqueEvents[] = $individual;
                $seenEventIds[] = $individual['event']->id;
            }
        }

        return $uniqueEvents;
    }

    private function findConflicts($scheduledEvents)
    {
        $conflicts = [];

        for ($i = 0; $i < count($scheduledEvents) - 1; $i++) {
            for ($j = $i + 1; $j < count($scheduledEvents); $j++) {
                if ($this->isConflict($scheduledEvents[$i], $scheduledEvents[$j])) {
                    $conflicts[] = [
                        'event1' => $scheduledEvents[$i]['event']->nama,
                        'event2' => $scheduledEvents[$j]['event']->nama,
                        'start1' => $scheduledEvents[$i]['startDay'],
                        'end1' => $scheduledEvents[$i]['endDay'],
                        'start2' => $scheduledEvents[$j]['startDay'],
                        'end2' => $scheduledEvents[$j]['endDay'],
                    ];
                }
            }
        }

        return $conflicts;
    }

    private function isConflict($event1, $event2)
    {
        return $event1['startDay'] <= $event2['endDay'] && $event2['startDay'] <= $event1['endDay'];
    }
}
