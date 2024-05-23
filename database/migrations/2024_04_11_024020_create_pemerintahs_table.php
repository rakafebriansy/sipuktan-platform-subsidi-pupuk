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
        Schema::create('pemerintahs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pengguna',60)->nullable(false);
            $table->string('kata_sandi',255)->nullable(false);
            $table->integer('id_musim_tanam')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemerintahs');
    }
};
