<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeterAir extends Model
{
 
    protected $table = 'meter_air';

    protected $fillable = [
        'pelanggan_id',
        'bulan',
        'tahun',
        'meter_awal',
        'meter_akhir',
        'pemakaian'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function tagihan()
    {
        return $this->hasOne(Tagihan::class);
    }
}
