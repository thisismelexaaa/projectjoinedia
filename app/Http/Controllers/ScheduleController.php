<?php

namespace App\Http\Controllers;

use App\Models\BuatEvent;
use App\Models\Event;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $events = collect();

        if ($request->has('bulan') && $request->has('tahun')) {
            $bulan = $request->bulan;
            $tahun = $request->tahun;


            $events = BuatEvent::where(function ($query) use ($tahun, $bulan) {
                $query->whereYear('start_date', $tahun)
                      ->whereMonth('start_date', $bulan)
                      ->whereIn('status', ['aktif', 'berjalan']);
            })
            ->orWhere(function ($query) use ($tahun, $bulan) {
                $query->whereYear('end_date', $tahun)
                      ->whereMonth('end_date', $bulan)
                      ->whereIn('status', ['aktif', 'berjalan']);
            })
            ->get();


            $events = $events->sortBy(function ($event) use ($bulan, $tahun) {
                // Prioritaskan event berdasarkan start_date, jika tidak memenuhi, gunakan end_date
                $startDatePriority = (date('Y-m', strtotime($event->start_date)) === "$tahun-$bulan") ? strtotime($event->start_date) : null;
                $endDatePriority = (date('Y-m', strtotime($event->end_date)) === "$tahun-$bulan") ? strtotime($event->end_date) : null;
                return $startDatePriority ?? $endDatePriority;
            });
        }

        return view('page.MakeSchedule.index', ['events' => $events]);
    }

    public function store(Request $request)
    {
        // Reuse the same logic as the index method for simplicity
        return $this->index($request);
    }

    public function checkDuplicates(Request $request)
    {
        $events = collect(); // Inisialisasi collection kosong

        // Check if bulan and tahun are present in the request
        if ($request->has('bulan') && $request->has('tahun')) {
            $bulan = $request->bulan;
            $tahun = $request->tahun;

            // Proses logika genetika untuk penjadwalan
            $events = BuatEvent::where(function ($query) use ($tahun, $bulan) {
                $query->whereYear('start_date', $tahun)
                      ->whereMonth('start_date', $bulan)
                      ->whereIn('status', ['aktif', 'berjalan']);
            })
            ->orWhere(function ($query) use ($tahun, $bulan) {
                $query->whereYear('end_date', $tahun)
                      ->whereMonth('end_date', $bulan)
                      ->whereIn('status', ['aktif', 'berjalan']);
            })
            ->get();

            // Sorting berdasarkan kondisi yang diberikan
            $events = $events->sortBy(function ($event) use ($bulan, $tahun) {
                // Prioritaskan event berdasarkan start_date, jika tidak memenuhi, gunakan end_date
                $startDatePriority = (date('Y-m', strtotime($event->start_date)) === "$tahun-$bulan") ? strtotime($event->start_date) : null;
                $endDatePriority = (date('Y-m', strtotime($event->end_date)) === "$tahun-$bulan") ? strtotime($event->end_date) : null;
                return $startDatePriority ?? $endDatePriority;
            });

            // Cek bentrokan tanggal
            $duplicates = $events->filter(function ($event, $key) use ($events) {
                foreach ($events as $otherEvent) {
                    if ($event->id !== $otherEvent->id && (
                        (strtotime($event->start_date) <= strtotime($otherEvent->end_date) && strtotime($event->start_date) >= strtotime($otherEvent->start_date)) ||
                        (strtotime($event->end_date) >= strtotime($otherEvent->start_date) && strtotime($event->end_date) <= strtotime($otherEvent->end_date))
                    )) {
                        return true;
                    }
                }
                return false;
            });
        }

        return view('page.MakeSchedule.index', ['events' => $duplicates]);
    }
}
