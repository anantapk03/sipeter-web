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
        Schema::create('pencatatan_kegiatan_promkes_desa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idKegiatanPromKesDesa')->references('id')->on('kegiatan_promosi_kesehatan_umum_desa');
            $table->foreignId('idDesa')->references('id')->on('wilayah_kerja');
            $table->integer('jumlah');
            $table->enum('bulan', ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12']);
            $table->integer('tahun');
            $table->text('deskripsi');  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pencatatan_kegiatan_promkes_desa');
    }
};
