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
        Schema::create('pemeriksaan_ibu_hamil', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idDesa')->references('id')->on('wilayah_kerja')->onDelete('cascade');
            $table->integer('jumlahTerdaftar');
            $table->integer('jumlahPenerimaTableTambahDarahMinimal90');
            $table->integer('jumlahPenderitaAnemia');
            $table->integer('jumlahKurangEnergiKronis');
            $table->integer('jumlahKekDapatPMT');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan_ibu_hamil');
    }
};
