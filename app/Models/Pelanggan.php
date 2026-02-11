<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
     protected $table = 'pelanggan';

    protected $fillable = [
        'no_sambungan','nama_kk','alamat','rt','rw','status'
    ];

    public function meterAir()
    {
        return $this->hasMany(MeterAir::class);
    }

    public function tagihan()
    {
        return $this->hasMany(Tagihan::class);
    }
}
