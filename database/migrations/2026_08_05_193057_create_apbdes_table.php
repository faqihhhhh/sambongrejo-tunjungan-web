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
        Schema::create('apbdes', function (Blueprint $table) {
            $table->id();
            $table->year('tahun')->unique();
            $table->bigInteger('pendapatan_anggaran')->default(0);
            $table->bigInteger('pendapatan_realisasi')->default(0);
            $table->bigInteger('belanja_anggaran')->default(0);
            $table->bigInteger('belanja_realisasi')->default(0);
            $table->bigInteger('pembiayaan_penerimaan_anggaran')->default(0);
            $table->bigInteger('pembiayaan_penerimaan_realisasi')->default(0);
            $table->bigInteger('pembiayaan_pengeluaran_anggaran')->default(0);
            $table->bigInteger('pembiayaan_pengeluaran_realisasi')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apbdes');
    }
};
