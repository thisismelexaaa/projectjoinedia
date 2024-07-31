<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventFormRequest;
use App\Models\BuatEvent;
use App\Models\Event;
use App\Models\Sponsor;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BuatEventController extends Controller
{
    public function buat(Request $request)
    {
        $buat_event = BuatEvent::create($request->all());

        return redirect()->route('event.index')->with('message', 'Yes! Data Berhasil Disimpan');
    }

    public function edit(BuatEvent $event)
    {
        $event = BuatEvent::where('id', $event->id)->first();
        dd($event);
        return view('page.admin.event.edit', compact('event'));
    }

    public function update(EventFormRequest $request, BuatEvent $event, Sponsor $sponsor)
    {
        $data = $request->validated();
        $dataSponsor = $request['sponsors'];
        $start_date = Carbon::parse($data['start_date']);
        $end_date = Carbon::parse($data['end_date']);



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
                        'start_date' => $start_date,
                        'end_date' => $end_date,
                        'description' => $sponsorData['description'],
                    ]);
                } else {
                    continue;
                }
            }
        }

        return redirect()->route('event.index')->with('message', 'Data Berhasil Diupdate');
    }

    public function show(BuatEvent $event)
    {

        $event = BuatEvent::where('id', $event->id)->first();

        dd($event);

        $eventexcept = BuatEvent::where('id', '!=', $event->id)->get()->take(5);


        $eventexcept = $eventexcept->shuffle();


        return view('page.admin.event.show', compact('event', 'eventexcept'));
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

    public function laporan()
    {
        $dataEvent = BuatEvent::all();
        $eventCount = $dataEvent->count();

        $pdf = PDF::loadView('page.admin.event.laporan', compact('dataEvent', 'eventCount'))
            ->setPaper('a4', 'landscape');

        $fileName = 'laporan_event_' . Carbon::now()->format('Y-m-d_H-i-s') . '.pdf';

        return $pdf->download($fileName);
    }

}
