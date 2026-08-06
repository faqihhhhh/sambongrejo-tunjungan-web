<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galeri_foto', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('file');
            $table->text('keterangan')->nullable();
            $table->date('tanggal')->nullable();
            $table->timestamps();
        });

        Schema::create('galeri_video', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('url_video'); // YouTube embed URL
            $table->string('thumbnail')->nullable();
            $table->text('keterangan')->nullable();
            $table->date('tanggal')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galeri_video');
        Schema::dropIfExists('galeri_foto');
    }
};
