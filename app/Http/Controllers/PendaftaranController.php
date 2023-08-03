<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Transaksi;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\PendaftaranFormRequest;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Pendaftaran $pendaftaran, Transaksi $transaksi)
    {
        $data = $pendaftaran->all();
        $dataTransaksi = $transaksi->all();
        // tampilkan data pendaftaran sesuai user
        if (auth()->user()->role == 'user') {
            $data = $pendaftaran->where('user_id', auth()->user()->id)->get();
        }

        return view('page.pendaftaran.index', compact('data', 'dataTransaksi'))->with('i', (request()->input('page', 1) - 1) * 20);;
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
        $tiket = $data['username'] . '#' . rand(1, 9999);
        $data['tiket'] = $tiket;

        $event = Event::find($request->event_id);

        if($event->type == 'gratis'){
            $data['status'] = 'paid';
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

        return redirect()->route('riwayat.index')->with('success', 'Pendaftaran berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event, string $id)
    {
        $data = $event->findOrFail($id);
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
}
