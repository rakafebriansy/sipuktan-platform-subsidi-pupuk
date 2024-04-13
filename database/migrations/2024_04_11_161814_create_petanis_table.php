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
        Schema::create('petanis', function (Blueprint $table) {
            $table->id();
            $table->char('nik',16)->nullable(false)->unique();
            $table->string('nama',60)->nullable(false);
            $table->string('kata_sandi',255)->nullable(false);
            $table->string('foto_ktp',255)->nullable(false);
            $table->string('nomor_telepon',20)->nullable(false)->unique();
            $table->unsignedBigInteger('id_kelompok_tani')->nullable(false);
            
            $table->foreign('id_kelompok_tani')->on('kelompok_tanis')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petanis');
    }
};
