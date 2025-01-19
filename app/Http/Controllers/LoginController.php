<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginBackend()
    {
        return view('backend.v_login.login', [
            'judul' => 'Login',
        ]);
    }

    public function authenticateBackend(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            if (Auth::user()->status == 0) {
                Auth::logout();
                return back()->with('error', 'User belum aktif');
            }
            // if (Auth::user()->role == 2) {
            //     Auth::logout();
            //     return back()->with('error', 'Customer tidak bisa menggunakan login backend');
            // }
            $request->session()->regenerate();
            if (Auth::user()->role == 2) {
                return redirect()->intended(route('frontend.beranda'));
            }
            return redirect()->intended(route('backend.beranda'));
        }
        return back()->with('error', 'Login Gagal');
    }

    public function logoutBackend()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect(route('frontend.beranda'));
    }
}