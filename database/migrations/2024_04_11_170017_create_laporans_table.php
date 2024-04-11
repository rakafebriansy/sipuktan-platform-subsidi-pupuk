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
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_pengambilan')->nullable(false);
            $table->string('foto_bukti_pengambilan',255)->nullable(false);
            $table->string('foto_ktp',255)->nullable(false);
            $table->string('surat_kuasa',255)->nullable(false);
            $table->string('tanda_tangan',255)->nullable(false);
            $table->enum('status_verifikasi',['Terverifikasi','Belum Diverifikasi','Ditolak'])->nullable(false);
            $table->unsignedBigInteger('id_transaksi')->nullable(false);

            $table->foreign('id_transaksi')->on('riwayat_transaksis')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
