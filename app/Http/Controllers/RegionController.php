<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role != 0) { // User is not admin
            return back()->with('error', 'Region page can only be accessed by Admin.');
        }

        $region = Region::orderBy('id')->get();
        return view('backend.v_region.index', [
            'judul' => 'Region Data',
            'index' => $region
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->role != 0) { 
            return back()->with('error', 'Region page can only be accessed by Admin.');
        }

        return view('backend.v_region.create', [
            'judul' => 'Add Region',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'nama_region' => 'required|max:255|unique:regions',
        ]);
        $validatedData['id'] = Null;
        Region::create($validatedData);
        return redirect()->route('backend.region.index')->with('success', 'Data Saved Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Region $region)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Region $region)
    {
        $region = Region::findOrFail($region->id);

        if (Auth::user()->role != 0) {
             return back()->with('error', 'Region page can only be accessed by Admin.');
        }

        return view('backend.v_region.edit', [
            'judul' => 'Edit Country',
            'edit' => $region
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Region $region)
    {
        $region = Region::findOrFail($region->id);
        $rules = [
            'nama_region' => 'required|max:255|unique:regions',
        ];
        $messages = [
            'nama_region.unique' => 'Region has been registered',
        ];

        $validatedData = $request->validate($rules, $messages);
        $region->update($validatedData);
        return redirect()->route('backend.region.index')->with('success', 'Data Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $region = Region::findOrFail($id);
        $region->delete();
        return redirect() -> route('backend.region.index')->with('success', 'Data successfully deleted');
    }
}
