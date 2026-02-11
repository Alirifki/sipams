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
        Schema::create('tarif_air', function (Blueprint $table) {
            $table->id();
            $table->integer('batas_bawah');
            $table->integer('batas_atas')->nullable();
            $table->dropColumn(['batas_bawah','batas_atas']);
            $table->decimal('biaya_tetap', 10, 2)->default(0);
            $table->decimal('harga_per_m3', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarif_air');
    }
};
