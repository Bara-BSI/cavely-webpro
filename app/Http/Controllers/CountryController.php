<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role != 0) { // User is not admin
            return back()->with('error', 'Halaman Country hanya dapat diakses oleh Admin.');
        }

        $region = Region::orderBy('nama_region')->get();
        $country = Country::orderBy('id')->get();
        return view('backend.v_country.index', [
            'judul' => 'Country Data',
            'index' => $country,
            'region' => $region
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->role != 0) { 
            return back()->with('error', 'Halaman Country hanya dapat diakses oleh Admin.');
        }

        $region = Region::orderBy('nama_region')->get();

        return view('backend.v_country.create', [
            'judul' => 'Add Country',
            'region' => $region
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'nama_negara' => 'required|max:255|unique:countries',
            'regions_id' => 'required|exists:regions,id',
        ]);
        $validatedData['id'] = Null;
        Country::create($validatedData);
        return redirect()->route('backend.country.index')->with('success', 'Data Saved Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country)
    {
        $country = Country::findOrFail($country->id);

        if (Auth::user()->role != 0) {
             return back()->with('error', 'Country page can only be accessed by Admin.');
        }
        
        $region = Region::orderBy('nama_region')->get();

        return view('backend.v_country.edit', [
            'judul' => 'Edit Country',
            'edit' => $country,
            'region' => $region
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Country $country)
    {
        $country = Country::findOrFail($country->id);
        $rules = [
            'nama_negara' => 'required|max:255|unique:countries',
            'regions_id' => 'required|exists:regions,id',
        ];
        $messages = [
            'nama_negara.unique' => 'Country has been registered',
        ];

        $validatedData = $request->validate($rules, $messages);
        $country->update($validatedData);
        return redirect()->route('backend.country.index')->with('success', 'Data Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $country = Country::findOrFail($id);
        $country->delete();
        return redirect() -> route('backend.country.index')->with('success', 'Data berhasil dihapus');
    }
}
