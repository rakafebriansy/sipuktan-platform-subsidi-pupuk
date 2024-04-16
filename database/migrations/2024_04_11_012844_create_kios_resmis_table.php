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
        Schema::create('kios_resmis', function (Blueprint $table) {
            $table->id();
            $table->string('nib',20)->nullable(false)->unique();
            $table->string('nama',60)->nullable(false);
            $table->string('jalan',255)->nullable(false);
            $table->string('kata_sandi',100)->nullable(false);
            $table->unsignedBigInteger('id_pemilik_kios')->nullable(false);
            $table->string('id_kecamatan',60)->nullable(false);
            $table->boolean('aktif')->nullable(false)->default(false);
            $table->rememberToken();

            $table->foreign('id_pemilik_kios')->on('pemilik_kios')->references('id');
            $table->foreign('id_kecamatan')->on('kecamatans')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kios_resmis');
    }
};
