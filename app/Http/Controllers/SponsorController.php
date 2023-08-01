<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\SponsorFormRequest;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sponsors = Sponsor::all();

        return view('page.sponsors.index', compact('sponsors'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('page.sponsors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SponsorFormRequest $request)
    {
        $data = $request->validated();

        // validate image
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('assets/images/sponsors');
            $image->move($destinationPath, $image_name);
            $data['logo'] = $image_name;
        }

        Sponsor::create($data);

        return redirect()->route('sponsor.index')->with('success', 'Sponsor created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sponsor $sponsor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sponsor $sponsor)
    {
        return view('page.sponsors.edit', compact('sponsor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sponsor $sponsor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sponsor $sponsor)
    {
        // Delete the image from the server
        if ($sponsor->image) {
            $imagePath = public_path('sponsorimage/' . $sponsor->image);

            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        // Delete the sponsor data from the database
        $sponsor->delete();

        return redirect()->route('sponsor.index')->with('success', 'Sponsor deleted successfully.');
    }
}
