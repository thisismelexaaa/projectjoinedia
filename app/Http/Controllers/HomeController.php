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
use Illuminate\Http\Request;
use Illuminate\Foundation\Inspiring;
>>>>>>> f89a811 (First Commit : Progress 80%)

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
<<<<<<< HEAD
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
        $event = BuatEvent::all(); // Mengambil semua data event
        $eventCounts = BuatEvent::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->take(5)
            ->toArray();

        $eventCount = array_sum($eventCounts);
        $eventAktif = $eventCounts['aktif'] ?? 0;
        $eventBerjalan = $eventCounts['berjalan'] ?? 0;
        $eventSelesai = $eventCounts['selesai'] ?? 0;
=======
        $userCount = User::count();
        $userAdminCount = User::where('role', 'admin')->count();
        $userSuperAdminCount = User::where('role', 'superadmin')->count();
        $usersCount = User::where('role', 'user')->count();

        // Count Event
        # Count all event
        $event = Event::all();
        $eventCount = Event::count();
        # Count event by status
        $eventAktif = Event::where('eventstatus', 'aktif')->count();
        $eventBerjalan = Event::where('eventstatus', 'berjalan')->count();
        $eventSelesai = Event::where('eventstatus', 'selesai')->count();
>>>>>>> f89a811 (First Commit : Progress 80%)

        // Quote
        $quote = Inspiring::quote();

<<<<<<< HEAD
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
=======
        // Show Home
        if ($user->role == 'superadmin' || $user->role == 'admin') {
            return view(
                'page.home.index',
                compact(
                    'user',
                    'eventCount',
                    'eventAktif',
                    'eventSelesai',
                    'userAdminCount',
                    'userSuperAdminCount',
                    'userCount',
                    'usersCount',
                    'event',
                    'quote',
                )
            );
        } else if ($user->role == 'user') {
            return view(
                'page.home.index',
                compact(
                    'user',
                    'eventCount',
                    'eventAktif',
                    'eventSelesai',
                    'userAdminCount',
                    'userSuperAdminCount',
                    'userCount',
                    'usersCount',
                    'event',
                    'quote',
                )
            );
        } else {
            return view('auth.login');
        }
>>>>>>> f89a811 (First Commit : Progress 80%)
    }
}
