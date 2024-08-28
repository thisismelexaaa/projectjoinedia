<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Transaksi;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\PendaftaranFormRequest;
<<<<<<< HEAD
=======
use App\Models\BuatEvent;
>>>>>>> ff25e2c2b33b6b5ae78ea40065c447fe23859f36

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Pendaftaran $pendaftaran, Transaksi $transaksi)
    {
        $data = $pendaftaran->all();
        $dataTransaksi = $transaksi->all();
        $user = Auth::user();

        if ($user->role == 'admin') {
            $data = $pendaftaran->all();
            $dataTransaksi = $transaksi->all();
        } else {
            $data = $pendaftaran->where('user_id', $user->id)->get();
        }

        return view('page.pendaftaran.index', compact('data', 'dataTransaksi'))->with('i', (request()->input('page', 1) - 1) * 20);
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
    public function store(PendaftaranFormRequest $request)
    {
        $data =  $request->validated();
        $data['user_id'] = auth()->user()->id;
        $tiket = $data['nama'] . '#' . rand(1, 9999);
        $data['tiket'] = $tiket;

<<<<<<< HEAD
        $event = Event::find($request->event_id);
=======
        $event = BuatEvent::findOrFail($request->event_id);
        // dd($event);
>>>>>>> ff25e2c2b33b6b5ae78ea40065c447fe23859f36

        // cek jika sudah terdaftar
        $cek = Pendaftaran::where('user_id', auth()->user()->id)->where('event_id', $request->event_id)->first();
        if ($cek) {
            // kembalikan ke halaman show event
            return redirect()->route('event.show', $request->event_id)->with('message', 'Anda sudah terdaftar pada event ini');
        }

        // cek kuota masih tersedia
        $kuota = Pendaftaran::where('event_id', $request->event_id)->count();
        if ($kuota >= $event->kuota) {
            // kembalikan ke halaman show event
            return redirect()->route('event.show', $request->event_id)->with('message', 'Kuota event sudah penuh');
        }

        if ($event->type == 'gratis') {
            $data['status'] = 'paid';

            $pendaftaran = Pendaftaran::create($data);

            Transaksi::create([
                'pendaftarans_id' => $pendaftaran->id,
                'doc_no' => $tiket,
                'description' => 'Pendaftaran ' . $event->name . ' oleh ' . $request->username . ' (' . $request->email . ')' . ' dengan tiket ' . $tiket,
                'amount' => 0, // Set amount to 0 for gratis events
                'payment_status' => 'paid', // Set payment status to 'paid' for gratis events
                'payment_link' => 'none', // No need for payment link for gratis events
            ]);

            // update kuota
            $event->update([
                'kuota' => $event->kuota - 1
            ]);

            // cek kuoata sudah habis
            if ($event->kuota == 0) {
                $event->update([
                    'status' => 'selesai'
                ]);
            }

            return redirect()->route('riwayat.index')->with('success', 'Pendaftaran berhasil');
        }

        $secret_key = 'Basic ' . config('xendit.key_auth');
        // $external_id = Str::random(10);


        $data_request = Http::withHeaders([
            'Authorization' => $secret_key
        ])->post('https://api.xendit.co/v2/invoices', [
            'external_id' => $tiket,
            'amount' => $event->price,
            'payment_methods' => [
                'BCA', 'BNI', 'BRI', 'MANDIRI', 'OVO', 'DANA', 'GOPAY', 'LINKAJA', 'SHOPEEPAY', 'QRIS',
            ],
            'payer_email' => $request->email,
            'description' => 'Pendaftaran ' . $event->name . ' oleh ' . $request->username . ' (' . $request->email . ')',
        ]);

        $response = $data_request->object();

        $pendaftaran = Pendaftaran::create($data);
        // dd($pendaftaran);

        Transaksi::create([
            'pendaftarans_id' => $pendaftaran->id,
            'doc_no' => $tiket,
            'description' => 'Pendaftaran ' . $event->name . ' oleh ' . $request->username . ' (' . $request->email . ')' . ' dengan tiket ' . $tiket,
            'amount' => $event->price,
            'payment_status' => 'unpaid',
            'payment_link' => $response->invoice_url,
        ]);

        // update kuota
        $event->kuota = $event->kuota - 1;
        if ($event->kuota == 0) {
            $event->update([
                'status' => 'selesai'
            ]);
        }
        $event->save();

        return redirect()->route('riwayat.index')->with('success', 'Pendaftaran berhasil');
    }

    /**
     * Display the specified resource.
     */
<<<<<<< HEAD
    public function show(Event $event, string $id)
    {
        $data = $event->findOrFail($id);
=======
    public function show($id)
    {
        $data = BuatEvent::where('id', $id)->first();
>>>>>>> ff25e2c2b33b6b5ae78ea40065c447fe23859f36
        $data->start_date = date('d F Y H:H', strtotime($data->start_date));
        $data->end_date = date('d F Y H:H', strtotime($data->end_date));
        return view('page.user.pendaftaran', compact('data'));
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
    public function destroy(Pendaftaran $pendaftaran, Transaksi $transaksi, string $id)
    {
        // delete
        $data = $pendaftaran->findOrFail($id);
        // cek tiket yang sama
        $deleteTransaksi = $transaksi->where('doc_no', $data->tiket)->get();
        $pendaftaran->destroy($id);
        $transaksi->destroy($deleteTransaksi);

        // update kuota
<<<<<<< HEAD
        $event = Event::find($data->event_id);
=======
        $event = BuatEvent::find($data->event_id);
>>>>>>> ff25e2c2b33b6b5ae78ea40065c447fe23859f36
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
        $data = request()->all();
        $status = $data['status'];
        $external_id = $data['external_id'];
        Transaksi::where('doc_no', $external_id)->update([
            'payment_status' => $status
        ]);

        Pendaftaran::where('tiket', $external_id)->update([
            'status' => $status
        ]);
        return response()->json($data);
        // return redirect()->route('riwayat.index')->with('success', 'Pembayaran berhasil');
    }

    public function laporanriwayat()
    {
        $data = Pendaftaran::all();
<<<<<<< HEAD
        $event = Event::all();
=======
        $event = BuatEvent::all();
>>>>>>> ff25e2c2b33b6b5ae78ea40065c447fe23859f36

        // Hitung total transaksi
        $totalTransaksi = $event->sum('price');
        $countRiwayat = $data->count();

        $pdf = PDF::loadView('page.pendaftaran.laporan', compact('data', 'totalTransaksi', 'countRiwayat'))
            ->setPaper('a4', 'landscape');

        $fileName = 'laporan_riwayat_' . Carbon::now()->format('Y-m-d_H-i-s') . '.pdf';

        return $pdf->download($fileName);
        // dd($event, $totalTransaksi);
        // return view('page.pendaftaran.laporan', compact('data', 'totalTransaksi', 'countRiwayat'));
    }
}
