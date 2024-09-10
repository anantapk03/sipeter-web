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
        Schema::create('laporan_imunisasi_baduta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idSasaranImunisasi')
                ->constrained('sasaran_imunisasi_baduta')
                ->onDelete('cascade');
            $table->foreignId('idJenisImunisasi')
                ->constrained('jenis_imunisasi_baduta')
                ->onDelete('cascade');
            $table->integer('jumlah_laki');
            $table->integer('jumlah_perempuan');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_imunisasi_baduta');
    }
};
