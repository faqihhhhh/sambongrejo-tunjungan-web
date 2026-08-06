<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('potensi_desa', function (Blueprint $table) {
            $table->id();
            $table->enum('kategori', ['umkm', 'wisata', 'peternakan', 'pertanian', 'perkebunan', 'perikanan']);
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('foto')->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('potensi_desa');
    }
};
