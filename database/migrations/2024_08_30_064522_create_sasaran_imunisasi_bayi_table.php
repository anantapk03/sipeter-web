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
        Schema::create('sasaran_imunisasi_bayi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idDesa')
                ->constrained('wilayah_kerja')
                ->onDelete('cascade');
            $table->integer('jumlah_sasaran_bayi_laki');
            $table->integer('jumlah_sasaran_bayi_perempuan');
            $table->integer('jumlah_surviving_infant_laki');
            $table->integer('jumlah_surviving_infant_perempuan');
            $table->enum('bulan', ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12']);
            $table->integer('tahun');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sasaran_imunisasi_bayi');
    }
};
