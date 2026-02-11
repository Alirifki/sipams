<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TarifAir extends Model
{
    protected $table = 'tarif_air';

    protected $fillable = [
        'harga_per_m3','biaya_tetap'
    ];
}
