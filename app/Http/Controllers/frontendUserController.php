<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class frontendUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $negara = Country::orderBy('nama_negara')->get();
        return view('frontend.v_user.create', [
            'judul' => 'Register',
            'negara' => $negara
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users',
            'role' => 'required',
            'hp' => 'required|min:10|max:13',
            'password' => 'required|min:4|confirmed',
            'foto' => 'image|mimes:jpeg,jpg,png,gif|file|max:1024',
            'tanggal_lahir' => 'required|date:Y-m-d',
            'countries_id' => 'required|exists:countries,id',
        ], $messages = [
            'foto.image' => 'Image format has to be jpeg, jpg, png, or gif.',
            'foto.max' => 'Maximum size for the image is 1MB.'
        ]);
        $validatedData['id'] = Null;
        $validatedData['status'] = 1;

        // Menggunakan ImageHelper
        if ($request->file('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
            $directory = 'storage/img-user/';

            // Simpan gambar dengan ukuran yang ditentukan
            ImageHelper::uploadAndResize($file, $directory, $originalFileName, 385, 400); // null (jika tinggi otomatis)
            
            // Simpan nama file asli di database
            $validatedData['foto'] = $originalFileName;
        }

        // Password kombinasi
        $password = $request->input('password');
        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/';
        // huruf kecil (a-z), huruf besar (A-Z), dan angka (\d) (?=.*([\W_])) simbol karakter (non-alphanumeric)
        if (preg_match($pattern, $password)) {
            $validatedData['password'] = Hash::make($validatedData['password']);
            User::create($validatedData, $messages);
            return redirect()->route('frontend.beranda')->with('success', 'Data successfully saved, now please login through the login page.');
        } else {
            return redirect()->back()->withErrors(['password' => 'Password consists CAPITAL letter, small letter, number, and special character.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
