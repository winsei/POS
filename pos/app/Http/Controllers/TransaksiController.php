<?php
// app/Http/Controllers/TransaksiController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        return view('kasir.transaksi');  // Menampilkan halaman transaksi.blade.php
    }
}

