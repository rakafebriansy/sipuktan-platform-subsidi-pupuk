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
        Schema::create('alokasis', function (Blueprint $table) {
            $table->id();
            $table->integer('jumlah_pupuk')->nullable(false);
            $table->enum('musim_tanam',['MT1','MT2','MT3'])->nullable(false);
            $table->string('tahun',4)->nullable(false);
            $table->string('id_jenis_pupuk',30)->nullable(false);
            $table->unsignedBigInteger('id_kios_resmi')->nullable(false);
            $table->unsignedBigInteger('id_petani')->nullable(false);

            $table->foreign('id_jenis_pupuk')->on('jenis_pupuks')->references('id');
            $table->foreign('id_petani')->on('petanis')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alokasis');
    }
};
