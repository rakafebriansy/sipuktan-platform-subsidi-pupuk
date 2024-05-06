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
        Schema::create('keluhans', function (Blueprint $table) {
            $table->id();
            $table->string('subjek')->nullable(false);
            $table->text('keluhan')->nullable(false);
            $table->text('balasan')->nullable();
            $table->date('tanggal_keluhan')->nullable(false)->useCurrent();
            $table->unsignedBigInteger('id_petani')->nullable(false);
            $table->unsignedBigInteger('id_kios_resmi')->nullable(false);
            $table->string('id_pemerintah',20)->nullable(false);

            $table->foreign('id_petani')->on('petanis')->references('id');
            $table->foreign('id_kios_resmi')->on('kios_resmis')->references('id');
            $table->foreign('id_pemerintah')->on('pemerintahs')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keluhans');
    }
};
