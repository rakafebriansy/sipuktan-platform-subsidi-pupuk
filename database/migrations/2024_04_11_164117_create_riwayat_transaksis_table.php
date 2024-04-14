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
        Schema::create('riwayat_transaksis', function (Blueprint $table) {
            $table->id();
            $table->timestamp('tanggal_transaksi')->nullable(false)->useCurrent();
            $table->enum('metode_pembayaran',['Tunai','Non-Tunai'])->nullable(false);
            $table->enum('status_pembayaran',['Menunggu Pembayaran','Dibayar','Dibatalkan'])->nullable(false);
            $table->unsignedBigInteger('id_alokasi')->nullable(false);
            $table->string('id_bank',60)->nullable();

            $table->foreign('id_alokasi')->on('alokasis')->references('id');
            $table->foreign('id_bank')->on('banks')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_transaksis');
    }
};
