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
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->text('pertanyaan')->nullable(false);
            $table->text('jawaban')->nullable(false);
            $table->enum('pengguna',['Petani','Kios Resmi'])->nullable(false);
            $table->string('id_pemerintah',20)->nullable(false);

            $table->foreign('id_pemerintah')->on('pemerintahs')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faqs');
    }
};
