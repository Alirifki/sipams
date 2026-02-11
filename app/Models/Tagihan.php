<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    
   protected $table = 'tagihan';

    protected $fillable = [
        'pelanggan_id',
        'meter_air_id',
        'bulan',
        'tahun',
        'total_pemakaian',
        'total_tagihan',
        'status'
    ];

    protected $dates = ['tanggal_bayar'];
     protected $appends = ['status_label'];

    public function getStatusLabelAttribute()
    {
        return $this->status == 1 ? 'Lunas' : 'Belum Bayar';
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function meter()
    {
        return $this->belongsTo(MeterAir::class, 'meter_air_id');
    }

}
