<?php

namespace App\Http\Controllers;

use App\Models\KasDesa;
use App\Models\MeterAir;
use App\Models\Tagihan;
use App\Models\TarifAir;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TagihanController extends Controller
{
    public function index()
    {
            $tagihan = Tagihan::with(['pelanggan','meter'])->get();

        return view('tagihan.index', compact('tagihan'));

    }

    public function show(Tagihan $tagihan)
    {
        $tagihan->load(['pelanggan','meter']);

        return view('tagihan.show', compact('tagihan'));
    }
    public function generate()
    {
        $bulan = now()->month;
        $tahun = now()->year;

        $tarif = TarifAir::first();
        if (!$tarif) {
            return back()->with('error','Tarif belum diatur');
        }

        $meterAir = MeterAir::where('bulan',$bulan)
            ->where('tahun',$tahun)
            ->get();

        foreach ($meterAir as $meter) {

            $cek = Tagihan::where('pelanggan_id',$meter->pelanggan_id)
                ->where('bulan',$bulan)
                ->where('tahun',$tahun)
                ->exists();

            if ($cek) continue;

            $total = ($meter->pemakaian * $tarif->harga_per_m3)
                + $tarif->biaya_tetap;
    
            Tagihan::create([
                'pelanggan_id'    => $meter->pelanggan_id,
                'meter_air_id'    => $meter->id,
                'bulan'           => $bulan,
                'tahun'           => $tahun,
                'total_pemakaian' => $meter->pemakaian,
                'total_tagihan'   => $total,
            ]);
        }

        return redirect()->route('tagihan.index')
            ->with('success','Tagihan berhasil digenerate');
    }

   public function verifikasi($id)
        {
            $tagihan = Tagihan::findOrFail($id);

            if ($tagihan->status == 1) {
                return back()->with('error', 'Tagihan sudah lunas');
            }

            // 1️⃣ Update tagihan
            $tagihan->update([
                'status'        => 1,
                'tanggal_bayar' => now()
            ]);

            // 2️⃣ Ambil saldo terakhir
            $saldoTerakhir = KasDesa::latest()->first();
            $saldoSekarang = $saldoTerakhir ? $saldoTerakhir->saldo : 0;

            $saldoBaru = $saldoSekarang + $tagihan->total_tagihan;

            // 3️⃣ Simpan ke kas
            KasDesa::create([
                'tanggal'    => now(),
                'keterangan' => 'Pembayaran Air - ' . $tagihan->pelanggan->nama_kk,
                'masuk'      => $tagihan->total_tagihan,
                'keluar'     => 0,
                'saldo'      => $saldoBaru
            ]);

            return back()->with('success', 'Pembayaran berhasil diverifikasi & kas bertambah');
        }

    public function cetak($id)
    {
            $tagihan = Tagihan::with(['pelanggan','meter'])->findOrFail($id);

        if ($tagihan->status != 1) {
            return back()->with('error', 'Tagihan belum dibayar');
        }

        // Nomor transaksi unik (timestamp)
        $noTransaksi = 'TRX-' . now()->format('YmdHis') . '-' . $tagihan->id;

            return view('tagihan.cetak', compact('tagihan','noTransaksi'));
    }

}
