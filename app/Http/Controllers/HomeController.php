<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Models\BuatEvent;
use App\Models\User;
use App\Models\Event;
use App\Models\Pendaftaran;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Auth;
=======
use App\Models\User;
use App\Models\Event;
use App\Models\Pendaftaran;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application home.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Show User Login Details
        $user = User::find(auth()->user()->id);

        // Count User
        $userCounts = User::selectRaw('role, count(*) as count')
            ->groupBy('role')
            ->pluck('count', 'role')
            ->toArray();

        $userCount = $userCounts['user'] ?? 0;
        $userAdminCount = $userCounts['admin'] ?? 0;
        $userSuperAdminCount = $userCounts['superadmin'] ?? 0;
        $usersCount = $userCount + $userAdminCount + $userSuperAdminCount;

        // Count Event
        # Count all event
        $event = Event::all(); // Mengambil semua data event
        $eventCounts = Event::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->take(5)
            ->toArray();

        $eventCount = array_sum($eventCounts);
        $eventAktif = $eventCounts['aktif'] ?? 0;
        $eventBerjalan = $eventCounts['berjalan'] ?? 0;
        $eventSelesai = $eventCounts['selesai'] ?? 0;

        // Quote
        $quote = Inspiring::quote();

        //show peseerta event
        $eventPendaftar = Pendaftaran::all();

        // Show Home
        $viewData = compact(
            'user',
            'eventCount',
            'eventAktif',
            'eventBerjalan',
            'eventSelesai',
            'userAdminCount',
            'userSuperAdminCount',
            'userCount',
            'usersCount',
            'event',
            'quote',
            'eventPendaftar'
        );

        // dd($eventPendaftar);
        $view = (Auth::user()->role) ? 'page.home.index' : 'auth.login';
        return view($view, $viewData);
    }
}
