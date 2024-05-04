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
        Schema::create('notifikasis', function (Blueprint $table) {
            $table->id();
            $table->text('isi')->nullable(false);
            $table->unsignedBigInteger('id_petani')->nullable();
            $table->unsignedBigInteger('id_kios_resmi')->nullable();
            $table->string('id_pemerintah',20)->nullable();

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
        Schema::dropIfExists('notifikasis');
    }
};
