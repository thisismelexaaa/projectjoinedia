<?php

use App\Http\Controllers\AlgoritmaGeneticController;
use App\Http\Controllers\BuatEventController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GeneticAlgorithmController;
use App\Http\Controllers\GoogleCalendarController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PenjadwalanController;
use App\Http\Controllers\ScheduleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get(
//     '/',
//     function () {
//         return view('welcome', LandingPageController::class);
//     }
// );

Route::get('/', [LandingPageController::class, 'index']);

Route::get('/phpinfo', function () {
    phpinfo();
});

Auth::routes();

// callback xendit
Route::post('/callback', [PendaftaranController::class, 'callback']);

Route::group(['middleware' => 'auth'], function () {
    // event
    Route::resource('home', HomeController::class);
    Route::resource('event', EventController::class);
    Route::get('/listpendaftar', [EventController::class, 'listpendaftar'])->name('listpendaftar');
    Route::get('/exportpdf/{id}', [EventController::class, 'exportpdfuser'])->name('exportpdfuser');
    Route::get('/laporan', [EventController::class, 'laporan'])->name('event.laporan');

    // Make Schedule
    Route::resource('make_schedule', ScheduleController::class)->except(['show']);
    Route::post('make_schedule/duplicate', [ScheduleController::class, 'checkDuplicates'])->name('make_schedule.duplicate');

    Route::get("/hapus-filter", [GeneticAlgorithmController::class, "hapusFilter"]);

    // Buat Event
    Route::post('buat_event', [BuatEventController::class, 'buat'])->name('be.store');
<<<<<<< HEAD
=======
    Route::get('/edit/{id}/event', [BuatEventController::class, 'edit'])->name('be.edit');
    Route::put('/update/{id}/event', [BuatEventController::class, 'update'])->name('be.update');
    Route::get('/show/{id}/event', [BuatEventController::class, 'show'])->name('be.show');
    Route::delete('/destroy/{id}/event', [BuatEventController::class, 'destroy'])->name('be.destroy');
    Route::get('/laporan/event', [BuatEventController::class, 'laporan'])->name('be.laporan');

    // Genetik
>>>>>>> ff25e2c2b33b6b5ae78ea40065c447fe23859f36
    Route::get('buatSchedule', [GeneticAlgorithmController::class, 'index'])->name('be.index');
    Route::post('/generate-schedule', [GeneticAlgorithmController::class, 'generateSchedule'])->name('be.algo');
    Route::post('/CekJadwalBentrok', [GeneticAlgorithmController::class, 'checkConflicts'])->name('be.checkConflicts');
    Route::put('/tambah/event/{id}', [GeneticAlgorithmController::class, 'tambah_calender'])->name('be.tambah_calender');

<<<<<<< HEAD
    Route::get('/test/{id}', function ($id) {
        return "Testing route with ID: $id";
    });
    
=======
>>>>>>> ff25e2c2b33b6b5ae78ea40065c447fe23859f36
    Route::post('google-calendar/connect', [GoogleCalendarController::class, 'connect'])->name('google-calendar.connect');
    Route::get('google-calendar/callback', [GoogleCalendarController::class, 'callback'])->name('google-calendar.callback');

    Route::post('google-calendar/event', [GoogleCalendarController::class, 'createEvent'])->name('google-calendar.createEvent');

    // Pendaftaran
    Route::resource('riwayat', PendaftaranController::class);
    Route::get('/laporanriwayat', [PendaftaranController::class, 'laporanriwayat'])->name('riwayat.laporanriwayat');

    // user
    Route::resource('user', UserController::class);
    Route::get('/laporanuser', [UserController::class, 'laporanuser'])->name('user.laporanuser');

    // Kalender
    Route::resource('penjadwalan', PenjadwalanController::class);
    Route::post('penjadwalan/optimalisasi', [PenjadwalanController::class, 'OptimalasisaData'])->name('penjadwalan.optimasi');

    // Sponsor
    Route::resource('sponsor', SponsorController::class);
    Route::get('/laporansponsor', [SponsorController::class, 'laporansponsor'])->name('sponsor.laporansponsor');
});

Route::get("/algoritma-genetika", [AlgoritmaGeneticController::class, "index"]);
