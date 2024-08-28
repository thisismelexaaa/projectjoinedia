<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BuatEvent;
use Carbon\Carbon;

class GeneticAlgorithmControllerOld extends Controller
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
        $bulan = $request->input('bulan', Carbon::now()->month);
        $tahun = $request->input('tahun', Carbon::now()->year);

        $events = BuatEvent::where('status', 'aktif')->get();

        $scheduledEvents = $this->geneticAlgorithm($events, $bulan, $tahun);

        session(['scheduledEvents' => $scheduledEvents]);
        session(["filter_bulan" => $bulan]);
        session(["filter_tahun" => $tahun]);

        session(['conflicts' => []]);

        return back()->with("success", "Berhasil Generate Jadwal");
    }

    public function checkConflicts(Request $request)
    {
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
        $today = Carbon::now();
        $population = $this->generateInitialPopulation($events, $today);

        // You can adjust the number of iterations if needed
        $iterations = max(10, min(100, count($events) * 10));
        for ($i = 0; $i < $iterations; $i++) {
            $selected = $this->selection($population);
            $offspring = $this->crossover($selected);
            $mutated = $this->mutation($offspring, $today);
            $population = $this->evaluate($mutated, $events, $today);
        }

        return $this->removeDuplicateEvents($population);
    }

    private function generateInitialPopulation($events, $today)
    {
        $population = [];
        $currentDate = $today->copy();

        foreach ($events as $event) {
            $startDay = $currentDate->day;
            $endDay = $startDay + $event->hari - 1;

            // Adjust end date if it goes beyond the current month
            if ($endDay > $currentDate->daysInMonth) {
                $endDay -= $currentDate->daysInMonth;
                $currentDate->addMonth();
                $currentDate->day = 1;
                $startDay = 1;
            }

            $population[] = [
                'event' => $event,
                'startDay' => $startDay,
                'endDay' => $endDay,
                'month' => $currentDate->month,
                'year' => $currentDate->year
            ];

            // Move the current date to the day after the current event ends
            $currentDate->addDays($event->hari);
        }

        return $population;
    }

    private function selection($population)
    {
        usort($population, function ($a, $b) {
            return $this->fitness($a) <=> $this->fitness($b);
        });

        return array_slice($population, 0, count($population) / 2);
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
                    'endDay' => $parent2['endDay'],
                    'month' => $parent2['month'],
                    'year' => $parent2['year']
                ];

                $child2 = [
                    'event' => $parent2['event'],
                    'startDay' => $parent1['startDay'],
                    'endDay' => $parent1['endDay'],
                    'month' => $parent1['month'],
                    'year' => $parent1['year']
                ];

                $offspring[] = $child1;
                $offspring[] = $child2;
            }
        }

        return $offspring;
    }

    private function mutation($offspring, $today)
    {
        foreach ($offspring as &$individual) {
            if (rand(0, 100) < 5) {
                $startDay = rand($today->day, $today->daysInMonth - $individual['event']->hari + 1);
                $endDay = $startDay + $individual['event']->hari - 1;

                // Adjust end date if it goes beyond the current month
                if ($endDay > $today->daysInMonth) {
                    $endDay -= $today->daysInMonth;
                    $today->addMonth();
                    $today->day = 1;
                    $startDay = 1;
                }

                $individual['startDay'] = $startDay;
                $individual['endDay'] = $endDay;
                $individual['month'] = $today->month;
                $individual['year'] = $today->year;
            }
        }

        return $offspring;
    }

    private function evaluate($mutated, $events, $today)
    {
        return array_merge($mutated, $this->generateInitialPopulation($events, $today));
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
        return $event1['startDay'] <= $event2['endDay'] && $event2['startDay'] <= $event1['endDay'] && $event1['month'] == $event2['month'];
    }
}
