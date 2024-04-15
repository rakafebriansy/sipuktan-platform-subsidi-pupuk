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
        Schema::create('kelompok_tanis', function (Blueprint $table) {
            $table->id();
            $table->string('nama',60)->nullable(false);
            $table->unsignedBigInteger('id_kios_resmi')->nullable(false);

            $table->foreign('id_kios_resmi')->on('kios_resmis')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelompok_tanis');
    }
};
