<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    // membuat function berandaBackend()
    public function berandaBackend()
    {
        if (auth()->user()->role == 2) {
            return redirect()->route('frontend.beranda');
        }
        return view('backend.v_beranda.index',[
            'judul' => 'Homepage'
        ]);
    }
    /**
     * Display a listing of the resource.
     */

    // membuat function frontendHomepage()
    public function berandaFrontend()
    {
        return view('frontend.v_beranda.index',[
            'judul' => 'Homepage'
        ]);
    }
}
