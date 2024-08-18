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
        Schema::create('pencatatan_kegiatan_program_kia_gizis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idKegiatanProgramKiaGizi')
                ->constrained('kegiatan_program_kia_gizis')
                ->onDelete('cascade');
            $table->foreignId('idDesa')
                ->constrained('wilayah_kerja')
                ->onDelete('cascade');
            $table->enum('bulan', [
                '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'
            ]);
            $table->integer('tahun');
            $table->integer('jumlah');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pencatatan_kegiatan_program_kia_gizis');
    }
};
