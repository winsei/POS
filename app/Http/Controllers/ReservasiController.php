<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keuangan; // Correct model import
use App\Models\Transaksi;
use Illuminate\Support\Str;

class ReservasiController extends Controller
{
    public function index()
    {
        return view('user.reservasi'); // Add this method to render the form
    }

    public function store(Request $request)
    {
        // Validasi Input - match field names from your form
        $validated = $request->validate([
            'customer' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'no_polisi' => 'required|string|max:20',
            'total' => 'nullable|numeric|min:0',
            'jenis_pembayaran' => 'nullable|in:cash,debit',
        ]);

        // Membuat nomor nota
        $lastTransaksi = Transaksi::orderBy('no_nota', 'desc')->first();
        $lastNumber = $lastTransaksi ? intval(substr($lastTransaksi->no_nota, 3)) : 0;
        $newNumber = $lastNumber + 1;
        $noNota = 'TRX' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        // Simpan Data ke Tabel Transaksi
        Transaksi::create([
            'no_nota' => $noNota,
            'customer' => $request->customer,
            'tanggal' => $request->tanggal,
            'no_polisi' => $request->no_polisi,
            'total' => $request->total ?? null, // Nilai default NULL
            'jenis_pembayaran' => $request->jenis_pembayaran ?? null, // Nilai default NULL
        ]);

        // Redirect dengan Pesan Sukses
        return redirect()->route('user.dashboard')->with('success', 'Reservasi berhasil disimpan!');
    }
}