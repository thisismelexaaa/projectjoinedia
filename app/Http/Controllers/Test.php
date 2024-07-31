<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BuatEvent;
use Carbon\Carbon;

class GeneticAlgorithmController extends Controller
{
    public function hapusFilter()
    {
        session()->forget("scheduledEvents");
        session()->forget("conflicts");
        session()->forget("filter_tahun");
        session()->forget("filter_bulan");

        return back()->with("success", "Filter Berhasil di Hapus");
    }

    public function index(Request $request)
    {
        $scheduledEvents = session('scheduledEvents', []);
        $conflicts = session('conflicts', []);
        return view('page.MakeSchedule.index', compact('scheduledEvents', 'conflicts'));
    }

    public function tambah_calender($id)
    {
        $scheduledEvents = session('scheduledEvents', []);

        $scheduledEvent = collect($scheduledEvents)->firstWhere('event.id', $id);

        if (!$scheduledEvent) {
            return redirect()->back()->with('error', 'Event not found in the scheduled events.');
        }

        $event = BuatEvent::findOrFail($id);
        $event->status = 'berjalan';
        $event->start_date = Carbon::createFromDate($scheduledEvent['year'], $scheduledEvent['month'], $scheduledEvent['startDay'])->toDateTimeString();
        $event->end_date = Carbon::createFromDate($scheduledEvent['year'], $scheduledEvent['month'], $scheduledEvent['endDay'])->toDateTimeString();
        $event->save();

        $googleCalendarController = new GoogleCalendarController();
        $googleCalendarController->createEvent($event);

        return redirect()->back()->with('success', 'Event created successfully and added to Google Calendar!');
    }

    public function generateSchedule(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $events = BuatEvent::where('status', 'aktif')->get();

        $scheduledEvents = $this->geneticAlgorithm($events, $bulan, $tahun);

        foreach ($scheduledEvents as &$event) {
            $event['year'] = $tahun;
            $event['month'] = $bulan;
        }

        session(['scheduledEvents' => $scheduledEvents]);
        session(["filter_bulan" => $bulan]);
        session(["filter_tahun" => $tahun]);

        session(['conflicts' => []]);

        return back()->with("success", "Berhasil Generate Jadwal");
    }

    public function checkConflicts(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $scheduledEvents = session('scheduledEvents', []);

        $conflicts = $this->findConflicts($scheduledEvents);

        session(['conflicts' => $conflicts]);

        if (count($conflicts) > 0) {
            return redirect()->back()->with('success', 'Conflict check completed!');
        } else {
            return redirect()->back()->with('error', 'No conflicts found.');
        }
    }

    private function geneticAlgorithm($events, $bulan, $tahun)
    {
        $daysInMonth = Carbon::createFromDate($tahun, $bulan, 1)->daysInMonth;

        $population = $this->generateInitialPopulation($events, $bulan, $tahun, $daysInMonth);

        $iterations = max(10, min(50, count($events) * 5));
        for ($i = 0; $i < $iterations; $i++) {
            $selected = $this->tournamentSelection($population);
            $offspring = $this->crossover($selected);
            $mutated = $this->mutation($offspring, $bulan, $tahun, $daysInMonth);
            $population = $this->evaluate($mutated, $events, $bulan, $tahun, $daysInMonth);
        }

        return $this->removeDuplicateEvents($population);
    }


    private function generateInitialPopulation($events, $bulan, $tahun, $daysInMonth)
    {
        $population = [];
        $availableDays = range(1, $daysInMonth);
        shuffle($availableDays);

        foreach ($events as $event) {
            do {
                $startDay = array_pop($availableDays);
            } while ($this->checkConflict($availableDays, $startDay, $event->hari, $daysInMonth));

            if ($startDay + $event->hari - 1 > $daysInMonth) {
                continue;
            }

            $population[] = [
                'event' => $event,
                'startDay' => $startDay,
                'endDay' => $startDay + $event->hari - 1
            ];
        }

        return $population;
    }

    private function checkConflict($usedDays, $startDay, $duration, $daysInMonth)
    {
        if ($startDay + $duration - 1 > $daysInMonth) {
            return true;
        }

        for ($i = 0; $i < $duration; $i++) {
            if (in_array($startDay + $i, $usedDays)) {
                return true;
            }
        }
        return false;
    }

    private function tournamentSelection($population)
    {
        $selected = [];
        $tournamentSize = 3;

        for ($i = 0; $i < count($population); $i++) {
            $tournament = [];

            for ($j = 0; $j < $tournamentSize; $j++) {
                $tournament[] = $population[rand(0, count($population) - 1)];
            }

            usort($tournament, function ($a, $b) {
                return $this->fitness($a) <=> $this->fitness($b);
            });

            $selected[] = $tournament[0];
        }

        return $selected;
    }

    private function crossover($selected)
    {
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

    private function mutation($offspring, $bulan, $tahun, $daysInMonth)
    {
        foreach ($offspring as &$individual) {
            if (rand(0, 100) < 5) {
                $individual['startDay'] = rand(1, $daysInMonth - $individual['event']->hari + 1);
                $individual['endDay'] = $individual['startDay'] + $individual['event']->hari - 1;
            }
        }

        return $offspring;
    }

    private function evaluate($mutated, $events, $bulan, $tahun, $daysInMonth)
    {
        return array_merge($mutated, $this->generateInitialPopulation($events, $bulan, $tahun, $daysInMonth));
    }


    private function fitness($individual)
    {
        $conflicts = $this->findConflicts([$individual]);
        return 1 / (count($conflicts) + 1);
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
