<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Helpers\ImageHelper;
use App\Models\Country;
use App\Models\Region;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role != 0) { // User is not admin
            return back()->with('error', 'Halaman User hanya dapat diakses oleh Admin.');
        }
        $user = User::orderBy('id')->get();
        return view('backend.v_user.index', [
            'judul' => 'User Data',
            'index' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->role != 0) { 
            return back()->with('error', 'Halaman User hanya dapat diakses oleh Admin.');
        }

        $negara = Country::orderBy('nama_negara')->get();
        return view('backend.v_user.create', [
            'judul' => 'Tambah User',
            'negara' => $negara
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($negara);
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
            'foto.image' => 'Format gambar gunakan file dengan ekstensi jpeg, jpg, png, atau gif.',
            'foto.max' => 'Ukuran file gambar Maksimal adalah 1024 KB.'
        ]);
        $validatedData['id'] = Null;
        $validatedData['status'] = 0;

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
            return redirect()->route('backend.user.index')->with('success', 'Data berhasil tersimpan');
        } else {
            return redirect()->back()->withErrors(['password' => 'Password harus terdiri dari kombinasi huruf besar, huruf kecil, angka, dan simbol karakter.']);
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
        $user = User::findOrFail($id);
        $negara = Country::orderBy('nama_negara')->get();

        if (Auth::user()->role != 0 && Auth::user()->id != $user->id) {  // Allow non-admins to edit their own profiles
             return back()->with('error', 'Halaman User lain hanya dapat diakses oleh Admin.');
        }

        return view('backend.v_user.edit', [
            'judul' => 'Ubah User',
            'edit' => $user,
            'negara' => $negara
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //ddd($request);
        $user = User::findOrFail($id);
        $rules = [
            'nama' => 'required|max:255',
            'role' => 'required',
            'status' => 'required',
            'hp' => 'required|min:10|max:13',
            'foto' => 'image|mimes:jpeg,jpg,png,gif|file|max:1024',
            'tanggal_lahir' => 'required|date:Y-m-d',
            'countries_id' => 'required|exists:countries,id',
        ];
        $messages = [
            'foto.image' => 'Format gambar gunakan file dengan ekstensi jpeg, jpg, png, atau gif.',
            'foto.max' => 'Ukuran file gambar Maksimal adalah 1024 KB.'
        ];

        if ($request->email != $user->email) {
            $rules['email'] = 'required|max:255|email|unique:users';
        }
        $validatedData = $request->validate($rules, $messages);

        // Menggunakan ImageHelper
        try {
            if ($request->file('foto')) {
                // hapus gambar lama
                if ($user->foto) {
                    $oldImagePath = public_path('storage/img-user/') . $user->foto;
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                $file = $request->file('foto');
                $extension = $file->getClientOriginalExtension();
                $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
                $directory = 'storage/img-user/';
                // Simpan gambar dengan ukuran yang ditentukan
                ImageHelper::uploadAndResize($file, $directory, $originalFileName, 385, 400); // null (jika tinggi otomatis)
                // Simpan nama file asli di database
                $validatedData['foto'] = $originalFileName;
            }
        } catch (\Exception $e) {
            return back()->withErrors('Tidak dapat mengunggah gambar:' . $e->getMessage());
        }
        $user->update($validatedData);
        if (Auth::user()->role == 0){
            return redirect()->route('backend.user.index')->with('success', 'Data berhasil diperbaharui');
        }
        return redirect()->route('backend.beranda')->with('success', 'Data berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        if ($user->foto) {
            $oldImagePath = public_path('storage/img-user/') . $user->foto;
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        $user->delete();
        return redirect() -> route('backend.user.index')->with('success', 'Data berhasil dihapus');
    }

    public function cetakUser()
    {
        $user = User::orderBy('id')->get();
        $country = Country::orderBy('nama_negara')->get();
        $region = Region::orderBy('nama_region')->get();
        return view('backend.v_user.print', [
            'judul' => 'User Data',
            'index' => $user,
            'country' => $country,
            'region' => $region,
        ]);
    }
}
