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
        Schema::create('kredensial_ubah_sandis', function (Blueprint $table) {
            $table->id();
            $table->string('token',255)->nullable(false);
            $table->unsignedBigInteger('id_petani')->nullable();
            $table->unsignedBigInteger('id_pemilik_kios')->nullable();
            $table->timestamps();

            $table->foreign('id_petani')->on('petanis')->references('id');
            $table->foreign('id_pemilik_kios')->on('pemilik_kios')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kredensial_ubah_sandis');
    }
};
