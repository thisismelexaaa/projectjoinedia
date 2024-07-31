<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Sponsor;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EventFormRequest;
use App\Models\BuatEvent;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\Facades\DataTables;

class EventController extends Controller
{
    public function index()
    {
        $dataEvent = BuatEvent::latest()
            ->get();

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

                        return '
                        <div class="d-flex gap-2">
                            <a class="btn btn-sm btn-warning" href="' . $editUrl . '" data-bs-toggle="tooltip" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a class="btn btn-sm btn-primary" href="' . $showUrl . '" data-bs-toggle="tooltip" title="Show">
                                <i class="bi bi-eye"></i>
                            </a>
                            ' . $deleteButton . '
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
        $start_date = Carbon::parse($data['start_date']);
        $end_date = Carbon::parse($data['end_date']);



        if ($event->whereDate('start_date', [$start_date->toDateString(), $end_date->toDateString()])->exists()) {
            return redirect()->back()->withInput()->with('message', 'Maaf, Tanggal Sudah Terdaftar');
        }

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
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'description' => $request->input('deskripsiSponsor' . $i),
                ]);
            } else {
                continue;
            }
        }

        $event->penjadwalan()->create(['event_id' => $event->id]);

        return redirect()->route('event.index')->with('message', 'Yes! Data Berhasil Disimpan');
    }

    public function show(Event $event)
    {

        $event = BuatEvent::where('id', $event->id)->first();

        $eventexcept = BuatEvent::where('id', '!=', $event->id)->get()->take(5);


        $eventexcept = $eventexcept->shuffle();


        return view('page.admin.event.show', compact('event', 'eventexcept'));
    }

    public function edit(Event $event)
    {
        $event = BuatEvent::where('id', $event->id)->first();
        return view('page.admin.event.edit', compact('event'));
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
        }

        return redirect()->route('event.index')->with('message', 'Data Berhasil Diupdate');
    }

    public function destroy(BuatEvent $event, Sponsor $sponsor)
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
    }
}
