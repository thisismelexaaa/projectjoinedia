<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // tampilkan semua user
        $dataUser = User::latest()->paginate(20);

        // tampilkan role user saja
        $user = User::where('role', 'user')->latest()->paginate(20);

        // deteksi role user
        $role = auth()->user()->role;

        return view('page.admin.user.index', compact('user', 'dataUser'))->with('i', (request()->input('page', 1) - 1) * 20);
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
        if ($request->file('userimage') == "") {
            // update without image
            $data = $request->validated();
            $user->fill($data);
            $user->update();
        } else {
            // delete old image
            Storage::disk('local')->delete('public/userimage/' . $user->userimage);

            // upload new image
            $data = $request->validated();
            $image = $request->file('userimage');
            $image->storeAs('public/userimage', $image->hashName());
            $data['userimage'] = $image->hashName();

            $user->fill($data);
            $user->save();
        }

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
        Storage::disk('local')->delete('public/userimage/' . $user->userimage);
        $user->delete();
        return redirect()->route('user.index')->with('message', 'Data Berhasil Dihapus');
    }
}
