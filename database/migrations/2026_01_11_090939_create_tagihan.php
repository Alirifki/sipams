<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
   {
            Schema::create('tagihan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelanggan_id')->constrained('pelanggan')->cascadeOnDelete();
            $table->foreignId('meter_air_id')->constrained('meter_air')->cascadeOnDelete();
            $table->tinyInteger('bulan');
            $table->year('tahun');
            $table->integer('total_pemakaian');
            $table->integer('total_tagihan');
            $table->enum('status', ['belum_bayar','lunas'])->default('belum_bayar');
            $table->timestamps();

            $table->unique(['pelanggan_id','bulan','tahun']);
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihan');
    }
};
