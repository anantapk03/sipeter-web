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
        Schema::create('sasaran_imunisasi_wus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idDesa')->references('id')->on('wilayah_kerja');
            $table->integer('jumlahSasaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sasaran_imunisasi_wus');
    }
};