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
        Schema::create('jenis_pupuks', function (Blueprint $table) {
            $table->string('id',30)->nullable(false)->primary();
            $table->string('jenis',30)->nullable(false);
            $table->integer('harga')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_pupuks');
    }
};
