<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailBarang;
use App\Models\DetailService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Data untuk kartu dashboard
        $pendapatanHariIni = DetailBarang::whereDate('created_at', Carbon::today())->sum('subtotal') +
                             DetailService::whereDate('created_at', Carbon::today())->sum('subtotal');

        $serviceHariIni = DetailService::whereDate('created_at', Carbon::today())->sum('jumlah');

        $barangTerjualHariIni = DetailBarang::whereDate('created_at', Carbon::today())->sum('jumlah');


        // Data untuk grafik total service
        $totalServiceData = $this->getTotalServiceData();

        // Data untuk grafik item terjual
        $itemTerjualData = $this->getItemTerjualData();

        // Tentukan view berdasarkan role
        $role = auth()->user()->role;
        $viewName = $this->getViewNameByRole($role);

        return view($viewName, compact(
            'pendapatanHariIni',
            'serviceHariIni',
            'barangTerjualHariIni',
            'totalServiceData',
            'itemTerjualData'
        ));
    }

    private function getTotalServiceData()
    {
        $totalServiceData = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'June', 'July', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec'],
            'values' => array_fill(0, 12, 0)  // Inisialisasi dengan 0 untuk setiap bulan
        ];

        $servicePerMonth = DB::table('detail_services')
                            ->selectRaw('MONTH(created_at) as month_number, COUNT(*) as total')
                            ->whereYear('created_at', Carbon::now()->year)
                            ->groupBy('month_number')
                            ->orderBy('month_number')
                            ->get();

        foreach ($servicePerMonth as $data) {
            $totalServiceData['values'][$data->month_number - 1] = $data->total;
        }

        return $totalServiceData;
    }

    private function getItemTerjualData()
    {
        $itemTerjualData = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'June', 'July', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec'],
            'values' => array_fill(0, 12, 0)  // Inisialisasi dengan 0 untuk setiap bulan
        ];

        $itemsPerMonth = DB::table('detail_barangs')
                            ->selectRaw('MONTH(created_at) as month_number, SUM(jumlah) as total')
                            ->whereYear('created_at', Carbon::now()->year)
                            ->groupBy('month_number')
                            ->orderBy('month_number')
                            ->get();

        foreach ($itemsPerMonth as $data) {
            $itemTerjualData['values'][$data->month_number - 1] = $data->total;
        }

        return $itemTerjualData;
    }

    private function getViewNameByRole($role)
    {
        $roleToViewMap = [
            'admin' => 'admin.dashboard',
            'kasir' => 'kasir.dashboard',
            'owner' => 'owner.dashboard',
            'user'  => 'user.dashboard'
        ];

        return $roleToViewMap[$role] ?? 'user.dashboard'; // Default ke user.dashboard jika role tidak dikenali
    }
}
