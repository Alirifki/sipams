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
    public function index(Request $request)
    {
        $bulan = $request->bulan ? (int)$request->bulan : Carbon::now()->month;
        $tahun = $request->tahun ? (int)$request->tahun : Carbon::now()->year;

        $pelanggan = Pelanggan::all();

        $meter = MeterAir::with('pelanggan')
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('meterair.index', compact('meter','pelanggan','bulan','tahun'));
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

    public function storeManual(Request $request)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'bulan'        => 'required|integer|min:1|max:12',
            'tahun'        => 'required|integer',
            'meter_awal'   => 'required|integer|min:0',
            'meter_akhir'  => 'required|integer|gte:meter_awal',
        ]);

        // CEK DUPLIKAT
        $cek = MeterAir::where('pelanggan_id', $request->pelanggan_id)
            ->where('bulan', $request->bulan)
            ->where('tahun', $request->tahun)
            ->first();

        if ($cek) {
            return back()->with('error', 'Data meter bulan ini sudah ada!');
        }

        $pemakaian = $request->meter_akhir - $request->meter_awal;

        MeterAir::create([
            'pelanggan_id' => $request->pelanggan_id,
            'bulan'        => $request->bulan,
            'tahun'        => $request->tahun,
            'meter_awal'   => $request->meter_awal,
            'meter_akhir'  => $request->meter_akhir,
            'pemakaian'    => $pemakaian,
        ]);

        return back()->with('success', 'Meter manual berhasil disimpan');
    }
}
