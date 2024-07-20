<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BuatEvent;
use Illuminate\Http\Request;

class BuatEventController extends Controller
{
    public function buat(Request $request)
    {
        $buat_event = BuatEvent::create($request->all());

        return redirect()->route('event.index')->with('message', 'Yes! Data Berhasil Disimpan');
    }
}
