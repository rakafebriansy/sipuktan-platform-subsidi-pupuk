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
        Schema::create('musim_tanams', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->enum('musim_tanam',['MT1','MT2','MT3'])->nullable(false);
            $table->integer('tahun')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('musim_tanams');
    }
};
