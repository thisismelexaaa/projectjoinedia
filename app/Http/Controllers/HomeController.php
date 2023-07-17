<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Foundation\Inspiring;

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

        // Quote
        $quote = Inspiring::quote();

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
    }
}
