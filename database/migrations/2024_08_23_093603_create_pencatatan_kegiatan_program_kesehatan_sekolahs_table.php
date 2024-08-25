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
        Schema::create('pencatatan_kegiatan_program_kesehatan_sekolahs', function (Blueprint $table) {
            $table->id();

            // Foreign key untuk kegiatan_program_kesehatan_sekolah
            $table->foreignId('idKegiatanProgramKesehatanSekolah')
                ->constrained('kegiatan_program_kesehatan_sekolahs')
                ->onDelete('cascade')
                ->name('fk_kegiatan_kesehatan');

            // Foreign key untuk kelas_siswa
            $table->foreignId('idKelasSiswa')
                ->constrained('kelas_siswas')
                ->onDelete('cascade')
                ->name('fk_kelas_siswa');

            $table->enum('bulan', ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12']);
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
        Schema::dropIfExists('pencatatan_kegiatan_program_kesehatan_sekolahs');
    }
};
