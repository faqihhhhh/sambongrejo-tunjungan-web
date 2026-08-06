<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kades');
            $table->string('jabatan_kades')->default('Kepala Desa');
            $table->string('foto_kades')->nullable();
            $table->text('sambutan_singkat')->nullable();
            $table->longText('sambutan_lengkap')->nullable();
            $table->longText('sejarah')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            // Data singkat desa
            $table->string('luas_wilayah')->nullable();
            $table->string('jumlah_penduduk')->nullable();
            $table->string('jumlah_kk')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('alamat_kantor')->nullable();
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
