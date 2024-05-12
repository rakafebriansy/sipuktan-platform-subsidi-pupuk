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
        Schema::create('pemilik_kios', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemilik',100)->nullable(false);
            $table->string('nik',100)->nullable(false)->unique();
            $table->string('foto_ktp',100)->nullable(false);
            $table->string('nomor_telepon',20)->nullable(false)->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemilik_kios');
    }
};
