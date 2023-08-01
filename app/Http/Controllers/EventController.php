<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EventFormRequest;
use App\Http\Requests\SponsorFormRequest;
use App\Models\Sponsor;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get data user

        $dataEvent = Event::all();
        if (Auth::user()->role == 'user') {
            return view('page.user.index', compact('dataEvent'))->with('i', (request()->input('page', 1) - 1) * 20);
        } else {
>>>>>>> f89a811 (First Commit : Progress 80%)
            return view('page.admin.event.index', compact('dataEvent'))->with('i', (request()->input('page', 1) - 1) * 20);
        }
    }

<<<<<<< HEAD
=======
    /**
     * Show the form for creating a new resource.
     */
>>>>>>> f89a811 (First Commit : Progress 80%)
    public function create()
    {
        return view('page.admin.event.create');
    }

<<<<<<< HEAD
    public function store(EventFormRequest $request, Event $event, Sponsor $sponsor)
    {
        $data = $request->validated();
        $numberOfSponsors = $request->input('number_of_sponsors');

        if ($request->hasFile('image')) {
            $imagePath = public_path('assets/images/eventimage');
            if (!file_exists($imagePath)) {

                mkdir($imagePath, 0755, true);
            }

            $image = $request->file('image');
            $imagePath = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/eventimage'), $imagePath);
            $data = $request->validated();
            $data['image'] = $imagePath;
        }


        $event = Event::create($data);

        for ($i = 0; $i <= $numberOfSponsors; $i++) {
            if ($request->input('sponsor_name' . $i) != null) {

                if ($request->hasFile('sponsor_logo' . $i)) {
                    $imagePath = public_path('assets/images/sponsorlogo/');
                    if (!file_exists($imagePath)) {

                        mkdir($imagePath, 0755, true);
                    }


                    $image = $request->file('sponsor_logo' . $i);
                    $imagePath = time() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('assets/images/sponsorlogo'), $imagePath);
                    $request['sponsor_logo' . $i] = $imagePath;
                }
                $sponsor->create([
                    'event_id' => $event->id,
                    'name' => $request->input('sponsor_name' . $i),
                    'logo' => $imagePath,
                    'description' => $request->input('deskripsiSponsor' . $i),
                ]);
            } else {
                continue;
            }
        }

        return redirect()->route('event.index')->with('message', 'Yes! Data Berhasil Disimpan');
    }

    public function show($id)
    {
        $event = BuatEvent::where('id', $id)->first();
        $eventexcept = BuatEvent::where('id', '!=', $event->id)->get()->take(5);
        $sponsor = Sponsor::where('event_id', $event->id)->get();

        $eventexcept = $eventexcept->shuffle();


        return view('page.admin.event.show', compact('event', 'eventexcept', 'sponsor'));
    }

    public function edit(Event $event)
    {
        $event = BuatEvent::where('id', $event->id)->first();
        $sponsor = Sponsor::where('event_id', $event->id)->get();
        $countSponsor = $sponsor->count();
        // dd($countSponsor);
        return view('page.admin.event.edit', compact('event', 'sponsor', 'countSponsor'));
    }

    public function update(EventFormRequest $request, BuatEvent $event, Sponsor $sponsor)
    {
        $data = $request->validated();
        $dataSponsor = $request['sponsors'];
        // $start_date = Carbon::parse($data['start_date']);
        // $end_date = Carbon::parse($data['end_date']);



        if ($request->hasFile('image')) {
            $imagePath = public_path('assets/images/eventimage/');
            if (!file_exists($imagePath)) {
                mkdir($imagePath, 0755, true);
            }


            $publicPath = public_path('assets/images/eventimage/') . $event->image;
            if (file_exists($publicPath) && is_file($publicPath)) {
                unlink($publicPath);
            }


            $image = $request->file('image');
            $imagePath = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/eventimage'), $imagePath);
            $data['image'] = $imagePath;
        }

        $event->update($data);

        if ($dataSponsor != null) {

            foreach ($dataSponsor as $sponsorData) {
                if (isset($sponsorData['id'])) {

                    $existingSponsor = Sponsor::find($sponsorData['id']);
                    $existingSponsor->name = $sponsorData['name'];
                    $existingSponsor->description = $sponsorData['description'];


                    if (isset($sponsorData['logo']) && $sponsorData['logo'] !== null) {
                        $image = $sponsorData['logo'];
                        $imagePath = time() . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('assets/images/sponsorlogo'), $imagePath);
                        $existingSponsor->logo = $imagePath;
                    }

                    $existingSponsor->save();
                } else if (isset($sponsorData['name'])) {

                    if ($request->hasFile('sponsor_logo')) {
                        $imagePath = public_path('assets/images/sponsorlogo/');
                        if (!file_exists($imagePath)) {

                            mkdir($imagePath, 0755, true);
                        }


                        $image = $request->file('sponsor_logo');
                        $imagePath = time() . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('assets/images/sponsorlogo'), $imagePath);
                        $request['sponsor_logo'] = $imagePath;
                    }
                    $sponsor->create([
                        'event_id' => $event->id,
                        'name' => $sponsorData['name'],
                        'description' => $sponsorData['description'],
                    ]);
                } else {
                    continue;
                }
            }
=======
    /**
     * Store a newly created resource in storage.
     */
    public function store(EventFormRequest $request, Event $event, Sponsor $sponsor)
    {
        $data = $request->validated();

        $start_date = Carbon::parse($data['start_date']);
        $end_date = Carbon::parse($data['end_date']);

        if ($event->whereDate('start_date', [$start_date->toDateString(), $end_date->toDateString()])->exists()) {
            return redirect()->back()->withInput()->with('message', 'Maaf, Tanggal Sudah Terdaftar');
        }

        if ($request->hasFile('image')) {
            $imagePath = public_path('assets/images/eventimage');
            if (!file_exists($imagePath)) {
                // Jika direktori belum ada, buat direktori baru dengan izin 0755 (boleh disesuaikan)
                mkdir($imagePath, 0755, true);
            }

            $image = $request->file('image');
            $imagePath = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/eventimage'), $imagePath);
            $data = $request->validated();
            $data['image'] = $imagePath;
        }

        $event = Event::create($data);

        if ($request->sponsor_name != null) {
            if ($request->hasFile('sponsor_logo')) {
                $sponsorImagePath = public_path('assets/images/sponsors');
                if (!file_exists($sponsorImagePath)) {
                    // Jika direktori belum ada, buat direktori baru dengan izin 0755 (boleh disesuaikan)
                    mkdir($sponsorImagePath, 0755, true);
                }

                $image = $request->file('sponsor_logo');
                $sponsorImagePath = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('assets/images/sponsors'), $sponsorImagePath);
            }
            $sponsor->create(
                [
                    'event_id' => $event->id,
                    'name' => $request->sponsor_name,
                    'logo' => $sponsorImagePath,
                    'start_date' => $data['start_date'],
                    'end_date' => $data['end_date'],
                    'description' => $request->deskripsiSponsor,
                ]
            );
        }

        $event->penjadwalan()->create(['event_id' => $event->id]);

        // dd($imagePath);
        return redirect()->route('event.index')->with('message', 'Yes! Data Berhasil Disimpan');
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
        $event->where('id', $event->id)->first();
        if ($event->sponsor()->exists() == false) {
            $sponsor = [
                'name' => null,
                'logo' => null,
                'start_date' => null,
                'end_date' => null,
                'description' => null,
            ];
        } else {
            $sponsor = $event->sponsor()->first();
        }
        return view('page.admin.event.edit', compact('event', 'sponsor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventFormRequest $request, Event $event, Sponsor $sponsor)
    {
        $data = $request->validated();
        $sponsor->where('event_id', $event->id)->delete();

        // Validasi Gambar
        if ($request->hasFile('image')) {
            $imagePath = public_path('assets/images/eventimage/');
            if (!file_exists($imagePath)) {
                // Jika direktori belum ada, buat direktori baru dengan izin 0755 (boleh disesuaikan)
                mkdir($imagePath, 0755, true);
            }

            // Hapus gambar lama jika ada
            if (file_exists(public_path('assets/images/eventimage/' . $event->image))) {
                unlink($imagePath . $event->image);
            }

            // Unggah gambar baru
            $image = $request->file('image');
            $imagePath = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/eventimage'), $imagePath);
            $data = $request->validated();
            $data['image'] = $imagePath;
        }

        if ($request->hasFile('sponsor_logo')) {
            $sponsorImagePath = public_path('assets/images/sponsors');
            if (!file_exists($sponsorImagePath)) {
                // Jika direktori belum ada, buat direktori baru dengan izin 0755 (boleh disesuaikan)
                mkdir($sponsorImagePath, 0755, true);
            }

            // Hapus gambar lama jika ada
            if (file_exists(public_path($sponsorImagePath))) {
                unlink($imagePath . $event->image);
            }

            $image = $request->file('sponsor_logo');
            $sponsorImagePath = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/sponsors'), $sponsorImagePath);
            $logo = $sponsorImagePath;
            // cek data sponsor sudah ada atau belum
            if ($event->sponsor()->exists() == false) {
                $sponsor->create(
                    [
                        'event_id' => $event->id,
                        'name' => $request->sponsor_name,
                        'logo' => $logo,
                        'start_date' => $data['start_date'],
                        'end_date' => $data['end_date'],
                        'description' => $request->deskripsiSponsor,
                    ]
                );
            } else {
                $sponsor->update(
                    [
                        'event_id' => $event->id,
                        'name' => $request->sponsor_name,
                        'logo' => $logo,
                        'start_date' => $data['start_date'],
                        'end_date' => $data['end_date'],
                        'description' => $request->deskripsiSponsor,
                    ]
                );
            }
        }

        // cek data sponsor sudah ada atau belum
        // Cek jika data sponsor yang di kirim kosong
        if ($request->sponsor_name != null) {
            if ($event->sponsor()->exists() == false) {
                $sponsor->create(
                    [
                        'event_id' => $event->id,
                        'name' => $request->sponsor_name,
                        'start_date' => $data['start_date'],
                        'end_date' => $data['end_date'],
                        'description' => $request->deskripsiSponsor,
                    ]
                );
            } else {
                $sponsor->update(
                    [
                        'event_id' => $event->id,
                        'name' => $request->sponsor_name,
                        'start_date' => $data['start_date'],
                        'end_date' => $data['end_date'],
                        'description' => $request->deskripsiSponsor,
                    ]
                );
            }
        }
        // dd($request);
        // Perbarui data event
        $event->update($data);

        return redirect()->route('event.index')->with('message', 'Data Berhasil Diupdate');
    }

<<<<<<< HEAD
    public function destroy(BuatEvent $event)
    {
        DB::beginTransaction();

        try {
            // Delete event image
            $this->deleteFile('assets/images/eventimage/', $event->image);

            // Delete sponsor logos and records
            $sponsors = Sponsor::where('event_id', $event->id)->get(); // Assuming you have a relationship defined
            foreach ($sponsors as $sponsor) {
                // dd($sponsor);
                $this->deleteFile('assets/images/sponsorlogo/', $sponsor->logo);
                $sponsor->delete();
            }

            $penjadwalan = Penjadwalan::where('event_id', $event->id)->delete();

            // Delete related records
            // $penjadwalan->delete();
            $event->delete();

            DB::commit();
            return redirect()->route('event.index')->with('message', 'Data Berhasil Dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    private function deleteFile($path, $filename)
    {
        if ($filename) {
            $fullPath = public_path($path . $filename);
            if (File::exists($fullPath)) {
                File::delete($fullPath);
            }
        }
    }

    public function listpendaftar()
    {
        $data = Event::all();

        return view('page.admin.listpendaftar', ['data' => $data])->with('i', (request()->input('page', 1) - 1) * 20);
    }

    public function laporan()
    {
        $dataEvent = Event::all();
        $eventCount = $dataEvent->count();

        $pdf = PDF::loadView('page.admin.event.laporan', compact('dataEvent', 'eventCount'))
            ->setPaper('a4', 'landscape');

        $fileName = 'laporan_event_' . Carbon::now()->format('Y-m-d_H-i-s') . '.pdf';

        return $pdf->download($fileName);
=======
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        // Hapus gambar dari direktori publik jika ada
        $publicPathEvent = public_path('assets/images/eventimage/') . $event->image;
        if (file_exists($publicPathEvent)) {
            unlink($publicPathEvent);
        }

        $event->penjadwalan()->delete();
        $event->delete();

        return redirect()->route('event.index')->with('message', 'Data Berhasil Dihapus');
    }

    public function listpendaftar()
    {
        $data = Event::all();
        // dd($dataPendaftar);
        return view('page.admin.listpendaftar', ['data' => $data])->with('i', (request()->input('page', 1) - 1) * 20);
    }
}
