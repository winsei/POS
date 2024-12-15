<?php

namespace App\Http\Controllers;

use App\Models\DetailBarang;
use App\Models\DetailService;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::paginate(10); // Menampilkan 10 transaksi per halaman
        return view('/admin/transaksi.index', compact('transaksis'));
    }

    public function tambah()
    {
        return view('/admin/transaksi.tambah');
    }

    public function simpan(Request $request)
    {
        $request->validate([
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

        Transaksi::create([
            'no_nota' => $noNota,
            'customer' => $request->customer,
            'tanggal' => $request->tanggal,
            'no_polisi' => $request->no_polisi,
            'total' => $request->total ?? null,
            'jenis_pembayaran' => $request->jenis_pembayaran ?? null,
        ]);

        return redirect('/transaksis')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function ubah($no_nota)
    {
        $transaksi = Transaksi::findOrFail($no_nota);
        return view('/admin/transaksi.ubah', compact('transaksi'));
    }

    public function simpan_ubah(Request $request, $no_nota)
    {
        $request->validate([
            'customer' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'no_polisi' => 'required|string|max:20',
            'total' => 'nullable|numeric|min:0',
            'jenis_pembayaran' => 'nullable|in:cash,debit',
        ]);

        $transaksi = Transaksi::findOrFail($no_nota);
        $transaksi->update($request->only(['customer', 'tanggal', 'no_polisi', 'total', 'jenis_pembayaran']));

        return redirect('/transaksis')->with('success', 'Transaksi berhasil diupdate.');
    }

    public function hapus($no_nota)
    {
        $transaksi = Transaksi::findOrFail($no_nota);
        $transaksi->delete();

        return redirect('/transaksis')->with('success', 'Transaksi berhasil dihapus.');
    }

    // Tampilkan detail transaksi
    public function show($no_nota)
    {
        $transaksi = Transaksi::with(['detailBarangs', 'detailServices'])->findOrFail($no_nota);
        return view('/admin/transaksi.detail', compact('transaksi'));
    }

    // Tambah detail barang
    public function tambahBarang(Request $request, $no_nota)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
        ]);

        DetailBarang::create([
            'no_nota' => $no_nota,
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
            'subtotal' => $request->jumlah * $request->harga,
        ]);

        $this->hitungTotal($no_nota);
        return redirect()->route('transaksi.detail', $no_nota);
    }

    // Tambah detail service
    public function tambahService(Request $request, $no_nota)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'harga' => 'required|numeric|min:0',
        ]);

        DetailService::create([
            'no_nota' => $no_nota,
            'service_id' => $request->service_id,
            'harga' => $request->harga,
            'subtotal' => $request->harga,
        ]);

        $this->hitungTotal($no_nota);
        return redirect()->route('transaksi.detail', $no_nota);
    }

    // Hitung total transaksi
    private function hitungTotal($no_nota)
    {
        $transaksi = Transaksi::with(['detailBarangs', 'detailServices'])->findOrFail($no_nota);
        $totalBarang = $transaksi->detailBarangs->sum('subtotal');
        $totalService = $transaksi->detailServices->sum('subtotal');
        $transaksi->total = $totalBarang + $totalService;
        $transaksi->save();
    }

    public function laporanBulanan()
    {
    // Mengelompokkan transaksi berdasarkan bulan dan menghitung total pendapatan per bulan
    $laporanBulanan = Transaksi::selectRaw('DATE_FORMAT(tanggal, "%Y-%m") as periode, SUM(total) as pendapatan')
        ->groupBy('periode')
        ->orderBy('periode', 'desc')
        ->get();

    return view('/admin/transaksi/laporan_bulanan', compact('laporanBulanan'));
    }

    public function laporanHarian($periode)
    {
    $laporanHarian = Transaksi::selectRaw('DATE(tanggal) as tanggal, SUM(total) as pendapatan')
        ->whereRaw('DATE_FORMAT(tanggal, "%Y-%m") = ?', [$periode])
        ->groupBy('tanggal')
        ->orderBy('tanggal', 'desc')
        ->get();

    return view('/admin/transaksi/laporan_harian', compact('laporanHarian', 'periode'));
    }

}
