<?php

namespace App\Http\Controllers;

use App\Models\User;
<<<<<<< HEAD
use App\Models\BuatEvent;
use App\Models\User;
=======
>>>>>>> f89a811 (First Commit : Progress 80%)
use App\Models\Event;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if ($event = Event::first()) {
            $event = Event::first()->paginate(6);
        } else {
            $event = [];
        }
        // count event
        $countEvent = Event::count();
        // count event yang sudah selesei
        $countEventFinish = Event::where('status', 'selesai')->count();
        $countEventNotFinish = Event::where('status', 'aktif')->count();
        // count user
        $countUser = User::count();

        return view('page.landingpage.landingpage', compact('event', 'countEvent', 'countEventFinish', 'countEventNotFinish', 'countUser'));
<<<<<<< HEAD
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
=======
        $event = Event::latest()->paginate(6);
        return view('page.landingpage.welcome', compact('event'));
>>>>>>> f89a811 (First Commit : Progress 80%)
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
