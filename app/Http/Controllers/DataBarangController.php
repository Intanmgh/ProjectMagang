<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataBarangController extends Controller
{
    public function index()
    {
        return view('stock_barang.index');
    }
}
