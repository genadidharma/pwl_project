<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KategoriBarang;
use App\Models\Stok;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $interval = CarbonPeriod::create(today()->subMonths(12), '1 month', today());

            $placeholder = collect($interval)->mapWithKeys(function ($item, $key) {
                return [$item->format('F') => 0];
            });

            $months = Transaksi::get()
                ->groupBy(function ($d) {
                    return Carbon::parse($d->created_at)->format('F');
                })
                ->map(function ($item) {
                    return collect($item)->count();
                });

            return response()->json($placeholder->merge($months));
        }

        $list_jumlah = (object) [
            'jumlah_pegawai' => User::count(),
            'jumlah_kategori_barang' => KategoriBarang::count(),
            'jumlah_barang' => Barang::count(),
            'jumlah_stok' => Stok::count()
        ];

        return view('admin.dashboard', compact('list_jumlah'));
    }
}
