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
        Schema::create('jumlah_kegiatan_kesehatan_umum_desa', function (Blueprint $table) {
            $table->id();
            #$table->foreignId('idKesehatanUmumDesa')->constrained('kegiatan_kesehatan_umum_desa')->onDelete('cascade');
            #$table->foreignId('idDesa')->constrained('wilayah_kerja')->onDelete('cascade');
            $table->foreignId('idDesa')->references('id')->on('wilayah_kerja')->onDelete('cascade');
            $table->foreignId('idKesehatanUmumDesa')->references('id')->on('kegiatan_kesehatan_umum_desa')->onDelete('cascade');
            $table->integer('jumlah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jumlah_kegiatan_kesehatan_umum_desa');
    }
};
