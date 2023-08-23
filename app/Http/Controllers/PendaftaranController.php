<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Models\Event;
use App\Models\Transaksi;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\PendaftaranFormRequest;
use App\Models\BuatEvent;
=======
use App\Models\User;
use App\Models\Event;
use App\Models\Transaksi;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\PendaftaranFormRequest;
>>>>>>> f89a811 (First Commit : Progress 80%)

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $pendaftaran->all();
        $dataTransaksi = $transaksi->all();
        $user = auth()->user();
        // Tampilkan event sesuai event_id yang ada di pendaftaran
        foreach ($data as $key => $value) {
            // Jika user yang login adalah admin, maka tampilkan semua event
            if (auth()->user()->role == 'admin') {
                $event = Event::find($value->event_id);
                $value->event = $event;
                continue;
            } else {
                // Jika user yang login adalah user biasa, maka tampilkan event yang sesuai dengan user_id
                if ($value->user_id == $user->id) {
                    $event = Event::find($value->event_id);
                    $value->event = $event;
                    // Jika event tidak ada, maka tampikan pesan event tidak ditemukan
                    if (!$value->event) {
                        $value->event = null;
                    }
                    continue;
                }
            }
        }

        // dd($value->transaksi);

        return view('page.pendaftaran.index', compact('data', 'dataTransaksi'))->with('i', (request()->input('page', 1) - 1) * 20);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('page.pendaftaran.show');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PendaftaranFormRequest $request)
    {
        // Memvalidasi data yang diinputkan
        try {
            $data = $request->validated();
            $random = rand(1, 1000);
            $data['nomertiket'] = $random;
            Pendaftaran::create($data);


            return redirect()->route('pendaftaran.index')->with('message', 'Yes! Data Berhasil Disimpan');
        } catch (\Exception $ex) {
            return redirect()->route('pendaftaran.index')->with('message', 'Waduh! Data Gagal Disimpan' . $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::find($id);
        $user = auth()->user();
        return view('page.pendaftaran.show', compact('event', 'user'));
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
        // delete
        $data = $pendaftaran->findOrFail($id);
        // cek tiket yang sama
        $deleteTransaksi = $transaksi->where('doc_no', $data->tiket)->get();
        $pendaftaran->destroy($id);
        $transaksi->destroy($deleteTransaksi);

        // update kuota
        $event = Event::find($data->event_id);
        $event->kuota = $event->kuota + 1;

        // cek kuoata sudah habis
        if ($event->kuota > 0) {
            $event->update([
                'status' => 'aktif'
            ]);
        }
        $event->save();
        return redirect()->route('riwayat.index')->with('success', 'Pendaftaran berhasil dihapus');
    }

    public function callback()
    {
        // Export PDF
        $data = Pendaftaran::all()->where('user_id', Auth::user()->id);
        foreach ($data as $item) {
            // $item->user = User::find($item->user_id);
            $item->event = Event::find($item->event_id);
            // dd($item->event->eventname);
            $pdf = Pdf::loadView('page.pendaftaran.detail-pdf', compact('item'))->setPaper('a4', 'portrait')->setOptions(['defaultFont' => 'sans-serif']);

            return $pdf->download('Eticket - ' . $item->event->eventname . ' - ' . $item->nomertiket . '.pdf');
            // return view('page.pendaftaran.detail-pdf', compact('item'))->with('i', (request()->input('page', 1) - 1) * 20);
        }
    }

    public function callback(Request $request)
    {

    }
}
