<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

/**
 * AUTH CONTROLLER
 * Mengelola Autentikasi Pengguna (Login, Auto-Create Admin Testing, dan Logout).
 */
class AuthController extends Controller
{
    /**
     * MENAMPILKAN FORM LOGIN
     */
    public function showLoginForm()
    {
        // Jika sudah login, langsung alihkan ke Dashboard
        if (Auth::check()) {
            return redirect()->route('dashboard.daftar-artikel');
        }

        return view('auth.form-login');
    }

    /**
     * PROSES LOGIN PENGGUNA (DATABASE)
     */
    public function login(Request $request)
    {
        // 1. Validasi Input Email & Password dari Form
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        // 2. Autentikasi Pengguna langsung dari Database (Auth::attempt)
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard')->with('success', 'Selamat datang kembali!');
        }

        // 3. Jika Email atau Password Salah
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    /**
     * PROSES LOGOUT PENGGUNA
     */
    public function logout(Request $request)
    {
        // 1. Logout dari Guard Auth Laravel
        Auth::logout();

        // 2. Hapus dan Perbarui Token Sesi (Mencegah CSRF Attack)
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // 3. Alihkan Pengguna ke Halaman Utama
        return redirect('/')->with('success', 'Anda telah berhasil keluar.');
    }
}

