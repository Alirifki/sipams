<?php

namespace App\Http\Controllers;

use App\Models\TarifAir;
use Illuminate\Http\Request;

class TarifAirController extends Controller
{
      public function index()
    {
        $tarif = TarifAir::first();
        return view('tarif.index', compact('tarif'));
    }

    public function store(Request $request)
    {
        TarifAir::updateOrCreate(
            ['id' => 1],
            $request->only('harga_per_m3','biaya_tetap')
        );

        return back()->with('success','Tarif air berhasil disimpan');
    }
}
