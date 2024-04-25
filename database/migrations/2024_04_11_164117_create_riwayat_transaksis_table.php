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
            $table->unsignedBigInteger('id_alokasi')->nullable(false);

            $table->foreign('id_alokasi')->on('alokasis')->references('id');
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
