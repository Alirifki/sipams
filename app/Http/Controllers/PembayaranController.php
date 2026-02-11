<?php

namespace App\Http\Controllers;

use App\Models\KasDesa;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
      public function store(Request $request)
    {
        DB::transaction(function () use ($request) {

            $tagihan = Tagihan::findOrFail($request->tagihan_id);

            Pembayaran::create([
                'tagihan_id' => $tagihan->id,
                'tanggal_bayar' => now(),
                'jumlah_bayar' => $tagihan->total_tagihan,
                'metode' => $request->metode,
                'user_id' => Auth::id()
            ]);

            $tagihan->update(['status' => 'lunas']);

            $saldoTerakhir = KasDesa::latest()->value('saldo') ?? 0;

            KasDesa::create([
                'tanggal' => now(),
                'keterangan' => 'Pembayaran air '.$tagihan->pelanggan->nama_kk,
                'debit' => $tagihan->total_tagihan,
                'kredit' => 0,
                'saldo' => $saldoTerakhir + $tagihan->total_tagihan
            ]);
        });

        return back()->with('success','Pembayaran berhasil & kas bertambah');
    }
}
