<?php

namespace App\Http\Controllers;

use App\Models\KasDesa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class KasDesaController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->bulan ? (int) $request->bulan : null;
        $tahun = $request->tahun ? (int) $request->tahun : null;

        $query = KasDesa::query();

        if ($bulan) {
            $query->whereMonth('tanggal', $bulan);
        }

        if ($tahun) {
            $query->whereYear('tanggal', $tahun);
        }

        // 🔹 Urutkan terbaru di atas
        $kas = $query->orderBy('tanggal', 'desc')->get();

        // 🔹 Ambil saldo TERBARU langsung dari DB
        $saldoSekarang = KasDesa::latest()->value('saldo') ?? 0;

        return view('kas.index', compact('kas','saldoSekarang','bulan','tahun'));
    }

    public function export(Request $request)
    {
        $bulan = $request->bulan ? (int) $request->bulan : null;
        $tahun = $request->tahun ? (int) $request->tahun : null;

        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $query = KasDesa::query();

        if ($bulan) {
            $query->whereMonth('tanggal', $bulan);
        }

        if ($tahun) {
            $query->whereYear('tanggal', $tahun);
        }

        $kas = $query->get();

        $totalMasuk = $kas->sum('masuk');
        $totalKeluar = $kas->sum('keluar');
        $saldoAkhir = $kas->last()->saldo ?? 0;

        $pdf = Pdf::loadView('kas.laporan_pdf', compact(
            'kas','bulan','tahun','totalMasuk','totalKeluar','saldoAkhir'
        ));

        return $pdf->download('laporan_kas.pdf');
    }
}
