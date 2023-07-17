<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EventFormRequest;
use Illuminate\Support\Facades\Storage;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get data user


        $dataEvent = Event::latest()->paginate(20);
        if (Auth::user()->role == 'user') {
            return view('page.user.index', compact('dataEvent'))->with('i', (request()->input('page', 1) - 1) * 20);
        } else {
            return view('page.admin.event.index', compact('dataEvent'))->with('i', (request()->input('page', 1) - 1) * 20);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('page.admin.event.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventFormRequest $request)
    {
        try {
            $data = $request->validated();

            $image = $request->file('eventimage');
            $image->storeAs('public/eventimage', $image->hashName());
            $data['eventimage'] = $image->hashName();

            Event::create($data);
            return redirect()->route('event.index')->with('message', 'Yes! Data Berhasil Disimpan');
        } catch (\Exception $ex) {
            return redirect()->route('event.index')->with('message', 'Waduh! Data Gagal Disimpan!' . $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        // show detail data event
        $event = Event::where('id', $event->id)->first();
        // ambil semua event kecuali yang sedang ditampilkan
        $eventexcept = Event::where('id', '!=', $event->id)->get();

        return view('page.admin.event.show', compact('event', 'eventexcept'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //edit data
        return view('page.admin.event.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventFormRequest $request, Event $event)
    {
        if ($request->file('eventimage') == "") {
            // update without image
            $data = $request->validated();
            $event->fill($data);
            $event->update();
        } else {
            // delete old image
            Storage::disk('local')->delete('public/eventimage/' . $event->eventimage);

            // upload new image
            $data = $request->validated();
            $image = $request->file('eventimage');
            $image->storeAs('public/eventimage', $image->hashName());
            $data['eventimage'] = $image->hashName();

            $event->fill($data);
            $event->update();
        }

        return redirect()->route('event.index')->with('message', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        // $dataEvent = Event::where('id', $id)->first();
        Storage::disk('local')->delete('public/eventimage/' . $event->eventimage);
        $event->delete();
        return redirect()->route('event.index')->with('message', 'Data Berhasil Dihapus');
    }

    public function listpendaftar(){
        $data = Event::all();
        $daftar = Pendaftaran::all();
        // dd($dataPendaftar);
        return view('page.admin.listpendaftar', ['data'=> $data],['daftar'=>$daftar])->with('i', (request()->input('page', 1) - 1) * 20);
    }
}
