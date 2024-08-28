<?php

namespace App\Http\Controllers;

use App\Models\BuatEvent;
use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if ($event = BuatEvent::first()) {
            $event = BuatEvent::first()->paginate(6);
        } else {
            $event = [];
        }
        // count event
        $countEvent = BuatEvent::count();

        // seleksi event yang sudah berjalan

        // count event yang sudah selesei
        $countEventFinish = BuatEvent::where('status', 'selesai')->count();
        $countEventNotFinish = BuatEvent::where('status', 'aktif')->count();
        // count user
        $countUser = User::count();

        return view('page.landingpage.landingpage', compact('event', 'countEvent', 'countEventFinish', 'countEventNotFinish', 'countUser'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
