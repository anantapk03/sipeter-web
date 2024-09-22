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
        Schema::create('laporan_imunisasi_bayi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idJenisImunisasi');
            $table->unsignedBigInteger('idSasaran');
            $table->integer('jumlah_laki');
            $table->integer('jumlah_perempuan');
            $table->text('deskripsi')->nullable();
            $table->timestamps();

            $table->foreign('idJenisImunisasi')
                  ->references('id')
                  ->on('jenis_imunisasi_bayi')
                  ->onDelete('cascade');

            $table->foreign('idSasaran')
                  ->references('id')
                  ->on('sasaran_imunisasi_bayi')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_imunisasi_bayi');
    }
};
