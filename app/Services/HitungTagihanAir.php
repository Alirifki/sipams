<?php

namespace App\Services;

use App\Models\TarifAir;

class HitungTagihanAir
{
    public static function hitung($pemakaian)
    {
        $tarif = TarifAir::firstOrFail();

        return ($pemakaian * $tarif->harga_per_m3) + $tarif->biaya_tetap;
    }
}
