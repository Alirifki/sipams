<?php

namespace App\Http\Controllers;

use App\Models\KasDesa;
use App\Models\Pelanggan;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Dashboard extends Controller
{
 public function dashboard() {   
   $tahun = Carbon::now()->year;

    // TOTAL DATA
    $totalPelanggan = Pelanggan::count();
    $belumBayar = Tagihan::where('status', 0)->count();

    // SALDO TERAKHIR
    $saldo = KasDesa::latest()->first();
    $saldoSekarang = $saldo ? $saldo->saldo : 0;

    // 📊 GRAFIK PEMASUKAN PER BULAN
    $grafik = KasDesa::select(
            DB::raw('MONTH(tanggal) as bulan'),
            DB::raw('SUM(masuk) as total')
        )
        ->whereYear('tanggal', $tahun)
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->get();

    $bulan = [];
    $total = [];

    for ($i = 1; $i <= 12; $i++) {
        $bulan[] = Carbon::create()->month($i)->format('F');
        $data = $grafik->firstWhere('bulan', $i);
        $total[] = $data ? $data->total : 0;
    }

    // 📅 5 TRANSAKSI TERAKHIR
    $transaksiTerakhir = KasDesa::latest()->take(5)->get();

    return view('dashboard', compact(
        'totalPelanggan',
        'belumBayar',
        'saldoSekarang',
        'bulan',
        'total',
        'transaksiTerakhir'
    ));
 }
}