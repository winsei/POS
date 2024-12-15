<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\DetailBarang;
use App\Models\DetailService;
use App\Models\Service;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    // Menampilkan halaman detail transaksi lengkap
    public function show($no_nota)
    {
        // Muat transaksi dengan relasi detail barang dan service
        $transaksi = Transaksi::with(['detailBarangs.barang', 'detailServices.service'])->findOrFail($no_nota);                      
        return view('/admin/detail.index', compact('transaksi')); 
    }

    public function tambahBarang($no_nota)
    {
        $transaksi = Transaksi::where('no_nota', $no_nota)->firstOrFail();
        $barangs = Barang::all();
        return view('/admin/detail.tambahbarang', compact('transaksi', 'barangs',));
    }

    public function simpanBarang($no_nota,Request $request)
    {
        $request->validate([
            'barang_id'=> 'required|int|min:1',
            'jumlah' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
            'subtotal' =>'required|numeric|min:0',
        ]);

        // Ambil data barang
        $barang = Barang::findOrFail($request->barang_id);

        // Cek apakah stok cukup
        if ($barang->stok < $request->jumlah) {
        return back()->withErrors(['jumlah' => 'Stok barang tidak mencukupi! Stok saat ini: ' . $barang->stok]);
        }

        // Kurangi stok barang
        $barang->stok -= $request->jumlah;
        $barang->save();

        DetailBarang::create([
            'no_nota' => $no_nota,
            'barang_id' => $request-> barang_id,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
            'subtotal' => $request->subtotal,
        ]);
        $this->updateTotalTransaksi($no_nota); // Update total transaksi
        
        return redirect()->route('transaksi.detail', ['no_nota' => $no_nota])
                     ->with('success', 'Barang berhasil ditambahkan.');
    }

    public function editBarang($id)
    {
        $detailBarang = DetailBarang::with('barang')->findOrFail($id);
        $barang = $detailBarang->barang; // Mengambil data barang terkait
        $transaksi = Transaksi::where('no_nota', $detailBarang->no_nota)->firstOrFail();

        return view('/admin/detail.ubahbarang', compact('detailBarang', 'barang', 'transaksi'));
    }

    public function updateBarang(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
        ]); 

        $detailBarang = DetailBarang::findOrFail($id);
        $barang = Barang::findOrFail($detailBarang->barang_id);

        // Hitung perubahan jumlah
        $perubahanJumlah = $request->jumlah - $detailBarang->jumlah;

        // Perbarui stok barang
        $barang->stok -= $perubahanJumlah;
        $barang->save();

        $barang = DetailBarang::findOrFail($id);
        $barang->update([
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
            'subtotal' => $request->jumlah * $request->harga, // Hitung ulang subtotal
        ]);
        $this->updateTotalTransaksi($barang->no_nota);
    
        // Redirect dengan pesan sukses
        return redirect()->route('transaksi.detail', ['no_nota' => $barang->no_nota])
                         ->with('success', 'Barang berhasil diupdate.');
    }

    public function hapusBarang($id)
    {
        $detailBarang = DetailBarang::findOrFail($id);
        $barang = Barang::findOrFail($detailBarang->barang_id);
        $barang->stok += $detailBarang->jumlah;
        $barang->save();
        $detailBarang->delete();
        $this->updateTotalTransaksi($barang->no_nota); // Update total transaksi setelah menghapus barang   
        return redirect()->route('transaksi.detail', ['no_nota' => $detailBarang->no_nota])
                         ->with('success', 'Barang berhasil dihapus.');
    }

    public function tambahService($no_nota)
    {
        $transaksi = Transaksi::where('no_nota', $no_nota)->firstOrFail();
        $services = Service::all();
        return view('/admin/detail.tambahservice', compact('transaksi', 'services',));
    }
    
    public function simpanService($no_nota,Request $request)
    {
        $request->validate([
            'service_id'=> 'required|int|min:1',
            'jumlah' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
            'subtotal' =>'required|numeric|min:0',
        ]);

        DetailService::create([
            'no_nota' => $no_nota,
            'service_id' => $request-> service_id,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
            'subtotal' => $request->subtotal,
        ]);

        $this->updateTotalTransaksi($no_nota);
        
        return redirect()->route('transaksi.detail', ['no_nota' => $no_nota])
                     ->with('success', 'Service berhasil ditambahkan.');
    }

    public function editService($id)
    {
        $detailService = DetailService::with('service')->findOrFail($id);
        $service = $detailService->service; // Mengambil data barang terkait
        $transaksi = Transaksi::where('no_nota', $detailService->no_nota)->firstOrFail();

        return view('/admin/detail.ubahservice', compact('detailService', 'service', 'transaksi'));
    }

    public function updateService(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
        ]); 

        $service = DetailService::findOrFail($id);
        $service->update([
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
            'subtotal' => $request->jumlah * $request->harga, // Hitung ulang subtotal
        ]);
        $this->updateTotalTransaksi($service->no_nota);
    
        // Redirect dengan pesan sukses
        return redirect()->route('transaksi.detail', ['no_nota' => $service->no_nota])
                         ->with('success', 'Service berhasil diupdate.');
    }

    public function hapusService($id)
    {
        $service = DetailService::findOrFail($id);
        $service->delete();

        $this->updateTotalTransaksi($service->no_nota);

        return redirect()->route('transaksi.detail', ['no_nota' => $service ->no_nota])
                         ->with('success', 'Service berhasil dihapus.');
    }

    public function updateTotalTransaksi($no_nota)
    {
        $transaksi = Transaksi::with(['detailBarangs', 'detailServices'])->where('no_nota', $no_nota)->firstOrFail();

        $totalBarang = $transaksi->detailBarangs->sum('subtotal');
        $totalService = $transaksi->detailServices->sum('subtotal');
    
        $total = $totalBarang + $totalService;

        // Update kolom total di tabel transaksi
    $transaksi->update(['total' => $total]);

    return $total; // Atau respons JSON jika dipanggil langsung
    }

    public function cetak($no_nota)
    {
        // Ambil data transaksi berdasarkan nomor nota
        $transaksi = Transaksi::with(['detailBarangs.barang', 'detailServices.service'])
            ->where('no_nota', $no_nota)
            ->firstOrFail();

        // Return ke view untuk mencetak
        return view('/admin/detail.cetak', compact('transaksi'));
    }



}
