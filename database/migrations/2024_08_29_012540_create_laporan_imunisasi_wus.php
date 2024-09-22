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
        Schema::create('laporan_imunisasi_wus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idSasaran')->references('id')->on('sasaran_imunisasi_wus');
            $table->foreignId('idJenis')->references('id')->on('jenis_imunisasi_wus');
            $table->integer('jumlah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_imunisasi_wus');
    }
};
