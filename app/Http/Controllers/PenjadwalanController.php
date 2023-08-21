<?php

namespace App\Http\Controllers;

use App\Models\Penjadwalan;
<<<<<<< HEAD
use Illuminate\Http\JsonResponse;
=======
>>>>>>> 8019b8b (70% Progress)
use Illuminate\Http\Request;

class PenjadwalanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwal = Penjadwalan::with('event')
            ->get()
            ->map(function ($item) {
                $sponsorLevel = $item->event->level;

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
                    'title' => $item->event->nama,
                    'start' => $item->event->start_date,
                    'end' => $item->event->end_date,
                    'url' => route('event.show', $item->event->id),
                    'backgroundColor' => $color,
                ];
            })
            ->all();

        return view('page.penjadwalan.index', compact('jadwal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Penjadwalan $penjadwalan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penjadwalan $penjadwalan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penjadwalan $penjadwalan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penjadwalan $penjadwalan)
    {
        //
    }
}
