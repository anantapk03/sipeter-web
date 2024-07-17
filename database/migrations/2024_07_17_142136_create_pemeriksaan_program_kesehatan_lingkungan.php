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
        Schema::create('pemeriksaan_program_kesehatan_lingkungan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idPromKes')->references('idPromKes')->on('program_kesehatan_lingkungan');
            $table->integer('jumlahPemeriksaan');
            $table->integer('jumlahResikoRendahSedang');
            $table->integer('jumlahResikoTinggiAmatTinggi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan_program_kesehatan_lingkungan');
    }
};
