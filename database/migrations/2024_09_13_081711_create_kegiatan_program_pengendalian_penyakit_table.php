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
        Schema::create('kegiatan_program_pengendalian_penyakit', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idProgram')
                ->constrained('program_pengendalian_penyakit')
                ->onDelete('cascade');
            $table->string('namaKegiatan');
            $table->integer('targetJumlah');
            $table->text('deskripsi')->nullable();
            $table->boolean('isActive')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan_program_pengendalian_penyakit');
    }
};
