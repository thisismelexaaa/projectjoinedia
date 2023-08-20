<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // tampilkan semua user
        $user = User::latest()->paginate(20);

        return view('page.admin.user.index', compact('user'))->with('i', (request()->input('page', 1) - 1) * 20);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Create User
        return view('page.admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserFormRequest $request)
    {
        // Store User
        try {
            $data = $request->validated();
            $data['password'] = bcrypt($data['password']);
            $data['email_verified_at'] = now();
            $data['bio'] = 'Belum Mengisi Bio';
            User::create($data);
            return redirect()->route('user.index')->with('message', 'Yes! Data Berhasil Disimpan');
        } catch (\Exception $ex) {
            return redirect()->route('user.index')->with('message', 'Waduh! Data Gagal Disimpan' . $ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //show user detail
        return view('page.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('page.admin.user.edit', compact('user'));
    }

    // update profile

    /**
     * Update the specified resource in storage.
     */
    public function update(UserFormRequest $request, User $user)
    {
        if ($request->hasFile('userimage')) {
            // delete old image
            $public_path = public_path('assets/images/userimage/');
            if (file_exists(public_path('assets/images/userimage/' . $user->userimage))) {
                unlink($public_path . $user->userimage);
            }

            // upload new image
            $image = $request->file('userimage');
            $imagePath = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/userimage'), $imagePath);
            $data = $request->validated();
            $data['userimage'] = $imagePath;
        } else {
            $data = $request->validated();
        }

        $user->fill($data);
        $user->save();

        // cek role user
        if (auth()->user()->role == 'admin' || auth()->user()->role == 'superadmin') {
            return redirect()->route('user.index')->with('message', 'Data Berhasil Diupdate');
        } else {
            return redirect()->route('user.show', $user->id)->with('message', 'Data Berhasil Diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //destroy data
        // delete old image
        if ($user->userimage && file_exists(public_path('assets/images/userimage/' . $user->userimage))) {
            unlink(public_path('assets/images/userimage/' . $user->userimage));
        }

        $user->delete();

        return redirect()->route('user.index')->with('message', 'Data Berhasil Dihapus');
    }

    public function laporanUser()
    {
        // tampilkan semua user
        $user = User::latest()->paginate(20);
        $countUser = $user->count();

        $pdf = PDF::loadView('page.admin.user.laporan', compact('user', 'countUser'))
            ->setPaper('a4', 'landscape');

        $fileName = 'laporan_user_' . Carbon::now()->format('Y-m-d_H-i-s') . '.pdf';

        return $pdf->download($fileName);

        // return view('page.admin.user.laporan', compact('user', 'countUser'))->with('i', (request()->input('page', 1) - 1) * 20);
    }
}
