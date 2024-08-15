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
        Schema::create('pencatatan_kegiatan_program_promkes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idKegiatanProgramPromkes');
            $table->integer('jumlah');
            $table->text('deskripsi')->nullable();
            $table->enum('bulan', ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12']);
            $table->integer('tahun');
            $table->timestamps();

            // Define a shorter name for the foreign key constraint
            $table->foreign('idKegiatanProgramPromkes', 'fk_kegiatan_program')
                ->references('id')
                ->on('kegiatan_program_promkes')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pencatatan_kegiatan_program_promkes');
    }
};
