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
        Schema::create('data_ukbm', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idDesa')->references('idDesa')->on('wilayah_kerja')->onDelete('cascade');
            $table->foreignId('idJenisUkbm')->references('idJenisUkbm')->on('jenis_ukbm')->onDelete('cascade');
            $table->string('namaUkbm');
            $table->string('alamatUkbm');
            $table->string('sumberPembiayaan');
            $table->string('kegiatanUkbm');
            $table->integer('jumlahKader');
            $table->integer('jumlahKaderDilatih');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_ukbm');
    }
};
