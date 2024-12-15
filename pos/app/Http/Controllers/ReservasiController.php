<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keuangan; // Correct model import
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
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'police_number' => 'required|string|max:15',
        ]);

        // Generate unique nota number
        $noNota = 'NOTA-' . now()->format('YmdHis') . '-' . Str::random(5);

        // Simpan Data ke Tabel Keuangan
        Keuangan::create([
            'customer' => $validated['name'],
            'no_telepon' => $validated['phone'],
            'no_polisi' => $validated['police_number'],
        ]);

        // Redirect dengan Pesan Sukses
        return redirect()->route('user.dashboard')->with('success', 'Reservasi berhasil disimpan!');
    }
}