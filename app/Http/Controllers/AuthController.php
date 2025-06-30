<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import facade Auth
use Illuminate\Support\Facades\Session; // Import facade Session

class AuthController extends Controller
{
    /**
     * Menampilkan form login.
     * @return \Illuminate\View\View
     */
    public function showLogin()
    {
        return view('auth.login'); // Asumsikan Anda memiliki view login di resources/views/auth/login.blade.php
    }

    /**
     * Memproses permintaan login.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validasi input dari form login
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba untuk mengotentikasi pengguna
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Regenerasi session ID untuk keamanan

            // Redirect ke halaman dashboard setelah login berhasil
            return redirect()->intended('/dashboard');
        }

        // Jika otentikasi gagal, kembali ke form login dengan pesan error
        return back()->withErrors([
            'email' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.',
        ])->onlyInput('email');
    }

    /**
     * Memproses permintaan logout.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout(); // Mengeluarkan pengguna dari sesi

        $request->session()->invalidate(); // Membatalkan sesi saat ini
        $request->session()->regenerateToken(); // Meregenerasi token CSRF

        // Redirect ke halaman login setelah logout
        return redirect('/login');
    }
}
