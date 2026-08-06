<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blangkos', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('file');
            $table->text('keterangan')->nullable();
            $table->string('ukuran_file')->nullable();
            $table->timestamps();
        });

        Schema::create('link_terkaits', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('url');
            $table->string('logo')->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('link_terkaits');
        Schema::dropIfExists('blangkos');
    }
};
