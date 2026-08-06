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
        Schema::table('profiles', function (Blueprint $table) {
            $table->text('maps_embed_url')->nullable()->after('email');
            $table->string('jam_pelayanan')->nullable()->after('maps_embed_url');
            $table->string('jam_istirahat')->nullable()->after('jam_pelayanan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn(['maps_embed_url', 'jam_pelayanan', 'jam_istirahat']);
        });
    }
};
