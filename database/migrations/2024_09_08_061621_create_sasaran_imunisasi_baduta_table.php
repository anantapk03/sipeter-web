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
        Schema::create('sasaran_imunisasi_baduta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idDesa')->constrained('wilayah_kerja')->onDelete('cascade');
            $table->integer('sasaran_laki');
            $table->integer('sasaran_perempuan');
            $table->text('deskripsi')->nullable();
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
        Schema::dropIfExists('sasaran_imunisasi_baduta');
    }
};
