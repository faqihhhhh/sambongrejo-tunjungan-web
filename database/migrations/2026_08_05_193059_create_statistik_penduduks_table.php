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
        Schema::create('statistik_penduduks', function (Blueprint $table) {
            $table->id();
            $table->string('kategori'); // Pendidikan, Pekerjaan, Agama, Usia, Jenis Kelamin
            $table->string('nama_item'); // e.g., "S1", "Petani", "Islam"
            $table->integer('jumlah')->default(0);
            $table->string('warna')->nullable(); // #HEX color for chart
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistik_penduduks');
    }
};
