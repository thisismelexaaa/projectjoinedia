<?php

namespace App\Http\Controllers;

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
                    ];
                }
            }
        }

        return $conflicts;
    }

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
    }
}
