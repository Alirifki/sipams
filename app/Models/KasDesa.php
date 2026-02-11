<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KasDesa extends Model
{
    protected $table = 'kas_desa';

    protected $fillable = [
         'tanggal',
        'keterangan',
        'masuk',
        'keluar',
        'saldo'
    ];
}
