<?php

namespace App\Http\Controllers;

use App\Models\Penjadwalan;
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
                $color = ($item->event->type == 'gratis') ? '#00713e' : '#f39c12';

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
