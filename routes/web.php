<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PenjadwalanController;

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

    // Pendaftaran
    Route::resource('riwayat', PendaftaranController::class);
    Route::get('/laporanriwayat', [PendaftaranController::class, 'laporanriwayat'])->name('riwayat.laporanriwayat');

    // user
    Route::resource('user', UserController::class);
    Route::get('/laporanuser', [UserController::class, 'laporanuser'])->name('user.laporanuser');

    // Kalender
    Route::resource('penjadwalan', PenjadwalanController::class);

    // Sponsor
    Route::resource('sponsor', SponsorController::class);
    Route::get('/laporansponsor', [SponsorController::class, 'laporansponsor'])->name('sponsor.laporansponsor');
});
