<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
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

        $iterations = max(10, min(100, count($events) * 10));
        for ($i = 0; $i < $iterations; $i++) {
            $selected = $this->selection($population);
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
=======
use App\Models\BuatEvent;
use App\Models\Event;
use App\Models\Penjadwalan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GeneticAlgorithmController extends Controller
{

    public function generateSchedule(Request $request)
    {
        try {
            DB::beginTransaction();

            // Ambil limit dari input
            $limit = $request->limit_data;

            // Ambil event dengan limit jika ada, jika tidak ambil semua event aktif
            if ($limit) {
                $events = BuatEvent::where('status', 'aktif')->orderBy('hari')->take($limit)->get()->toArray();
                // count event
                $count = count($events);
                if ($limit > $count) {
                    return redirect()->back()->with('error', 'Jumlah event yang diinginkan melebihi batas. Terdapat ' . $count . ' event aktif. Maksimal Limit adalah ' . $count);
                }
            } else {
                $events = BuatEvent::where('status', 'aktif')->orderBy('hari')->get()->toArray();
            }

            // Cek apakah ada event yang ditemukan
            if (empty($events)) {
                return redirect()->back()->with('error', 'No active events found.');
            }

            // Jalankan algoritma genetika
            $optimalSchedule = $this->geneticAlgorithm($events, 20, 150); // Ukuran populasi 20 dan 150 generasi

            // Simpan jadwal yang dihasilkan dalam sesi
            session(['generated_schedule' => $optimalSchedule]);

            DB::commit();

            return back()->with("success", "Generate Schedule Success");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with("error", $e->getMessage());
        }
    }

    public function tambah_calender(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $scheduledEvents = session('generated_schedule', []);

            $event = BuatEvent::where("id", $id)->first();

            $event->update([
                "status" => "berjalan",
                "start_date" => $request->tanggal_mulai,
                "end_date" => $request->tanggal_akhir
            ]);

            $googleCalendarController = new GoogleCalendarController();
            $googleCalendarController->createEvent($event);

            Penjadwalan::create([
                "event_id" => $event->id
            ]);

            $cek = BuatEvent::where("status", "aktif")->get();

            session(["generated_schedule" => $cek]);

            DB::commit();

            return redirect()->back()->with('success', 'Event created successfully and added to Google Calendar!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with("error", $e->getMessage());
        }
    }

    private function geneticAlgorithm($events, $populationSize, $generations)
    {
        $population = $this->initializePopulation($events, $populationSize);

        for ($i = 0; $i < $generations; $i++) {
            $parents = $this->selectParents($population);
            $newPopulation = [];

            for ($j = 0; $j < $populationSize / 2; $j++) {
                $offspring = $this->crossover($parents[0], $parents[1]);
                $newPopulation[] = $this->mutate($offspring[0]);
                $newPopulation[] = $this->mutate($offspring[1]);
            }

            $population = $newPopulation;
        }

        usort($population, function ($a, $b) {
            return $this->fitnessFunction($b) <=> $this->fitnessFunction($a);
        });

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
        return 1 / (count($conflicts) + 1);
    }

    private function selectParents($population)
    {
        usort($population, function ($a, $b) {
            return $this->fitnessFunction($b) <=> $this->fitnessFunction($a);
        });

        return array_slice($population, 0, 2);
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

        $temp = $individual[$index1];
        $individual[$index1] = $individual[$index2];
        $individual[$index2] = $temp;

        return $individual;
    }

    private function calculateConflicts($events)
    {
        $conflicts = [];
        $n = count($events);

        for ($i = 0; $i < $n; $i++) {
            for ($j = $i + 1; $j < $n; $j++) {
                $event1 = $events[$i];
                $event2 = $events[$j];

                if ($this->eventsOverlap($event1, $event2)) {
                    $conflicts[] = [
                        'event1' => $event1['id'],
                        'event2' => $event2['id']
>>>>>>> ff25e2c2b33b6b5ae78ea40065c447fe23859f36
                    ];
                }
            }
        }

        return $conflicts;
    }

<<<<<<< HEAD
    private function isConflict($event1, $event2)
    {
        return $event1['startDay'] <= $event2['endDay'] && $event2['startDay'] <= $event1['endDay'];
=======
    private function eventsOverlap($event1, $event2)
    {
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
            $eventDuration = $event['hari'];

            // Loop untuk mencari tanggal yang belum ada di database
            do {
                $startDate = $currentDate->format('Y-m-d');
                $endDate = $currentDate->copy()->addDays($eventDuration - 1)->format('Y-m-d');

                // Periksa apakah tanggal tersebut sudah ada di database
                $existingEvent = BuatEvent::where(function ($query) use ($startDate, $endDate) {
                    $query->whereBetween('start_date', [$startDate, $endDate])
                        ->orWhereBetween('end_date', [$startDate, $endDate])
                        ->orWhere(function ($query) use ($startDate, $endDate) {
                            $query->where('start_date', '<=', $startDate)
                                ->where('end_date', '>=', $endDate);
                        });
                })->exists();

                if (!$existingEvent) {
                    // Jika tanggal belum ada, set tanggal untuk event ini
                    $event['start_date'] = $startDate;
                    $event['end_date'] = $endDate;
                    break;
                }

                // Jika tanggal sudah ada, tambahkan 1 hari dan coba lagi
                $currentDate->addDay();
            } while ($existingEvent);

            // Tambahkan durasi untuk tanggal berikutnya
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
            BuatEvent::where('id', $eventData['id'])
                ->update([
                    'start_date' => $eventData['start_date'],
                    'end_date' => $eventData['end_date']
                ]);
        }

        return redirect()->back()->with('success', 'Schedule updated successfully!');
    }

    public function hapusFilter()
    {
        session()->forget("generated_schedule");
        session()->forget("conflicts");

        return back()->with("success", "Filter Berhasil di Hapus");
>>>>>>> ff25e2c2b33b6b5ae78ea40065c447fe23859f36
    }
}
