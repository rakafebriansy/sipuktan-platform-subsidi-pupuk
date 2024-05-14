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
            $table->timestamp('tanggal_pengambilan')->nullable(false)->useCurrent();
            $table->string('foto_bukti_pengambilan',255)->nullable(false);
            $table->string('foto_ktp',255)->nullable(false);
            $table->string('foto_surat_kuasa',255)->nullable();
            $table->string('foto_tanda_tangan',255)->nullable(false);
            $table->enum('status_verifikasi',['Terverifikasi','Belum Diverifikasi','Ditolak'])->nullable(false)->default('Belum Diverifikasi');
            $table->text('catatan')->nullable();
            $table->boolean('telah_diedit')->nullable(false)->default(0);
            $table->timestamp('tanggal_diedit')->nullable();
            $table->unsignedBigInteger('id_riwayat_transaksi')->nullable(false)->unique();

            $table->foreign('id_riwayat_transaksi')->on('riwayat_transaksis')->references('id');
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
