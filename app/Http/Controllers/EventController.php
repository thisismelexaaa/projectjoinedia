<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Sponsor;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EventFormRequest;
use App\Models\BuatEvent;
<<<<<<< HEAD
=======
use App\Models\Penjadwalan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
>>>>>>> ff25e2c2b33b6b5ae78ea40065c447fe23859f36
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\Facades\DataTables;

class EventController extends Controller
{
    public function index()
    {
        $dataEvent = BuatEvent::latest()
<<<<<<< HEAD
        ->get();
=======
            ->get();
>>>>>>> ff25e2c2b33b6b5ae78ea40065c447fe23859f36

        if (Auth::user()->role == 'user') {
            return view('page.user.index', compact('dataEvent'))->with('i', (request()->input('page', 1) - 1) * 20);
        } else {
            if (request()->ajax()) {
                return DataTables::of($dataEvent)
                    ->addColumn('date', function ($event) {
                        return [
                            'start_date' => $event->start_date,
                            'end_date' => $event->end_date
                        ];
                    })
                    ->addColumn(
                        'user',
                        function ($event) {
                            return $event->user->name;
                        }
                    )
                    ->addColumn('action', function ($event) {
<<<<<<< HEAD
                        $editUrl = route('event.edit', $event->id);
                        $showUrl = route('event.show', $event->id);
                        $deleteUrl = route('event.destroy', $event->id);
=======
                        $editUrl = url('/event/' . $event->id . '/edit');
                        $showUrl = url('/event/' . $event->id);
                        $deleteUrl = url('/event/' . $event->id);

                        $deleteButton = '';
                        if (is_null($event->start_date) || is_null($event->end_date)) {
                            $deleteButton = '
                    <form class="delete-form" action="' . $deleteUrl . '" method="post">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-sm btn-danger delete-event" data-bs-toggle="tooltip" title="Delete">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                ';
                        }
>>>>>>> ff25e2c2b33b6b5ae78ea40065c447fe23859f36

                        return '
                        <div class="d-flex gap-2">
                            <a class="btn btn-sm btn-warning" href="' . $editUrl . '" data-bs-toggle="tooltip" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a class="btn btn-sm btn-primary" href="' . $showUrl . '" data-bs-toggle="tooltip" title="Show">
                                <i class="bi bi-eye"></i>
                            </a>
<<<<<<< HEAD
                            <form class="delete-form" action="' . $deleteUrl . '" method="post">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="btn btn-sm btn-danger delete-event" data-bs-toggle="tooltip" title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
=======
                            ' . $deleteButton . '
>>>>>>> ff25e2c2b33b6b5ae78ea40065c447fe23859f36
                        </div>
                        ';
                    })
                    ->tojson();
            }
            return view('page.admin.event.index', compact('dataEvent'))->with('i', (request()->input('page', 1) - 1) * 20);
        }
    }

    public function create()
    {
        return view('page.admin.event.create');
    }

    public function store(EventFormRequest $request, Event $event, Sponsor $sponsor)
    {
        $data = $request->validated();
        $numberOfSponsors = $request->input('number_of_sponsors');
<<<<<<< HEAD
        $start_date = Carbon::parse($data['start_date']);
        $end_date = Carbon::parse($data['end_date']);



        if ($event->whereDate('start_date', [$start_date->toDateString(), $end_date->toDateString()])->exists()) {
            return redirect()->back()->withInput()->with('message', 'Maaf, Tanggal Sudah Terdaftar');
        }
=======
>>>>>>> ff25e2c2b33b6b5ae78ea40065c447fe23859f36

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
<<<<<<< HEAD
                    'start_date' => $start_date,
                    'end_date' => $end_date,
=======
>>>>>>> ff25e2c2b33b6b5ae78ea40065c447fe23859f36
                    'description' => $request->input('deskripsiSponsor' . $i),
                ]);
            } else {
                continue;
            }
        }

<<<<<<< HEAD
        $event->penjadwalan()->create(['event_id' => $event->id]);

        return redirect()->route('event.index')->with('message', 'Yes! Data Berhasil Disimpan');
    }

    public function show(Event $event)
    {

        $event = Event::where('id', $event->id)->first();

        $eventexcept = Event::where('id', '!=', $event->id)->get()->take(5);

=======
        return redirect()->route('event.index')->with('message', 'Yes! Data Berhasil Disimpan');
    }

    public function show($id)
    {
        $event = BuatEvent::where('id', $id)->first();
        $eventexcept = BuatEvent::where('id', '!=', $event->id)->get()->take(5);
        $sponsor = Sponsor::where('event_id', $event->id)->get();
>>>>>>> ff25e2c2b33b6b5ae78ea40065c447fe23859f36

        $eventexcept = $eventexcept->shuffle();


<<<<<<< HEAD
        return view('page.admin.event.show', compact('event', 'eventexcept'));
=======
        return view('page.admin.event.show', compact('event', 'eventexcept', 'sponsor'));
>>>>>>> ff25e2c2b33b6b5ae78ea40065c447fe23859f36
    }

    public function edit(Event $event)
    {
<<<<<<< HEAD

        $event = Event::where('id', $event->id)->first();
        return view('page.admin.event.edit', compact('event'));
    }

    public function update(EventFormRequest $request, Event $event, Sponsor $sponsor)
    {
        $data = $request->validated();
        $dataSponsor = $request['sponsors'];
        $start_date = Carbon::parse($data['start_date']);
        $end_date = Carbon::parse($data['end_date']);
=======
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
>>>>>>> ff25e2c2b33b6b5ae78ea40065c447fe23859f36



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

<<<<<<< HEAD


        $event->update($data);


=======
        $event->update($data);

>>>>>>> ff25e2c2b33b6b5ae78ea40065c447fe23859f36
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
<<<<<<< HEAD
                        'start_date' => $start_date,
                        'end_date' => $end_date,
=======
>>>>>>> ff25e2c2b33b6b5ae78ea40065c447fe23859f36
                        'description' => $sponsorData['description'],
                    ]);
                } else {
                    continue;
                }
            }
        }

        return redirect()->route('event.index')->with('message', 'Data Berhasil Diupdate');
    }

<<<<<<< HEAD
    public function destroy(Event $event, Sponsor $sponsor)
    {

        $publicPathEvent = public_path('assets/images/eventimage/') . $event->image;


        $sponsor = $sponsor->where('event_id', $event->id)->get();


        foreach ($sponsor as $s) {
            $publicPathSponsor = public_path('assets/images/sponsorlogo/') . $s->logo;
            if (file_exists($publicPathSponsor) && is_file($publicPathSponsor)) {
                unlink($publicPathSponsor);
            }
        }


        if (file_exists($publicPathEvent) && is_file($publicPathEvent)) {
            unlink($publicPathEvent);
        }

        $event->penjadwalan()->delete();
        $event->delete();

        return redirect()->route('event.index')->with('message', 'Data Berhasil Dihapus');
=======
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
>>>>>>> ff25e2c2b33b6b5ae78ea40065c447fe23859f36
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
<<<<<<< HEAD


=======
>>>>>>> ff25e2c2b33b6b5ae78ea40065c447fe23859f36
    }
}
