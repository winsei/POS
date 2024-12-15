<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        // Retrieve all records from the 'barangs' table
        $services = Service::all();
        
        // Return a view and pass the barangs data to it
        return view('/admin/service.index', compact('services'));
    }

    public function tambah()
    {
        return view('/admin/service.tambah');
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'nama_jasa' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
        ]);

        Service::create([
            'nama_jasa' => $request->nama_jasa,
            'harga' => $request->harga,
        ]);

        return redirect('/services')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function ubah($id)
    {
        $service = Service::findOrFail($id);
        return view('/admin/service.ubah', compact('service'));
    }

    public function simpan_ubah(Request $request, $id)
    {
        $request->validate([
            'nama_jasa' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
        ]);

        $service = Service::findOrFail($id);
        $service->update($request->only(['nama_jasa', 'harga',]));

        return redirect('/services')->with('success', 'Barang berhasil diupdate.');
    }

    public function hapus($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect('/services')->with('success', 'Barang berhasil dihapus.');
    }
}
