<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard utama.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('dashboard'); // Mengarahkan ke resources/views/dashboard.blade.php
    }
}
