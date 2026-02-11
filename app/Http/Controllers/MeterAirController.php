<?php

namespace App\Http\Controllers;

use App\Models\MeterAir;
use App\Models\Pelanggan;
use App\Models\Tagihan;
use App\Services\HitungTagihanAir;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class MeterAirController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::all();
        $meter = MeterAir::with('pelanggan')
            ->orderBy('tahun','desc')
            ->orderBy('bulan','desc')
            ->get();

        return view('meterair.index', compact('pelanggan','meter'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'meter_akhir'  => 'required|numeric|min:0'
        ]);

        // 🔹 Ambil bulan & tahun sekarang otomatis
        $bulan = Carbon::now()->month;
        $tahun = Carbon::now()->year;

        // 🔹 Cek apakah sudah input bulan ini
        $cek = MeterAir::where('pelanggan_id', $request->pelanggan_id)
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->first();

        if ($cek) {
            return back()->with('error', 'Meter bulan ini sudah diinput');
        }

        // 🔹 Ambil meter akhir bulan sebelumnya
        $meterSebelumnya = MeterAir::where('pelanggan_id', $request->pelanggan_id)
            ->orderBy('tahun','desc')
            ->orderBy('bulan','desc')
            ->first();

        $meterAwal = $meterSebelumnya ? $meterSebelumnya->meter_akhir : 0;

        $pemakaian = $request->meter_akhir - $meterAwal;

        if ($pemakaian < 0) {
            return back()->with('error', 'Meter akhir tidak boleh lebih kecil dari meter awal');
        }

        MeterAir::create([
            'pelanggan_id' => $request->pelanggan_id,
            'bulan'        => $bulan,
            'tahun'        => $tahun,
            'meter_awal'   => $meterAwal,
            'meter_akhir'  => $request->meter_akhir,
            'pemakaian'    => $pemakaian,
        ]);

        return back()->with('success', 'Meter berhasil disimpan');
    }
}
