<?php

namespace Database\Seeders;

use App\Models\TarifAir;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TarifAirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TarifAir::create([
        'harga_per_m3' => 2000,
        'biaya_tetap' => 5000
        ]);
    }
}
