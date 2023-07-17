<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\Api\TransaksiController;

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

Route::group(['middleware' => 'auth'], function () {
    // event
    Route::resource('home', HomeController::class);
    Route::resource('event', EventController::class);
    Route::get('/listpendaftar', [EventController::class, 'listpendaftar'])->name('listpendaftar');
    Route::get('/exportpdf/{id}', [EventController::class, 'exportpdfuser'])->name('exportpdfuser');
    // user
    Route::resource('user', UserController::class);
    // Pendaftaran
    Route::resource('pendaftaran', PendaftaranController::class);
    Route::get('/detail/{id}', [PendaftaranController::class, 'detail'])->name('detail');
    Route::get('/exportpdf', [PendaftaranController::class, 'exportpdf'])->name('exportpdf');
    Route::get('/callback', [PendaftaranController::class, 'callback'])->name('callback');
});


