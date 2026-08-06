<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ppid_categories', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        Schema::create('ppid_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ppid_category_id')->constrained()->onDelete('cascade');
            $table->string('judul');
            $table->longText('isi')->nullable();
            $table->string('file')->nullable();
            $table->date('tanggal')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ppid_items');
        Schema::dropIfExists('ppid_categories');
    }
};
