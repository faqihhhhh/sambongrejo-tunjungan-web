<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hukum_categories', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->timestamps();
        });

        Schema::create('hukum_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hukum_category_id')->constrained()->onDelete('cascade');
            $table->string('judul');
            $table->string('nomor_dokumen')->nullable();
            $table->string('file_pdf');
            $table->date('tanggal');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hukum_documents');
        Schema::dropIfExists('hukum_categories');
    }
};
