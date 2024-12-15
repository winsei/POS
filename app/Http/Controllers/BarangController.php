<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::paginate(10); // Menampilkan 10 transaksi per halaman
        
        // Return a view and pass the barangs data to it
        return view('/admin/barang.index', compact('barangs'));
    }

    public function tambah()
    {
        return view('/admin/barang.tambah');
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        Barang::create([
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);

        return redirect('/barangs')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function ubah($id)
    {
        $barang = Barang::findOrFail($id);
        return view('/admin/barang.ubah', compact('barang'));
    }

    public function simpan_ubah(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update($request->only(['nama_barang', 'harga', 'stok']));

        return redirect('/barangs')->with('success', 'Barang berhasil diupdate.');
    }

    public function hapus($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect('/barangs')->with('success', 'Barang berhasil dihapus.');
    }
}