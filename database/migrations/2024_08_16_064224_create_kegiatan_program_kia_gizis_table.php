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
        Schema::create('kegiatan_program_kia_gizis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idProgramKiaGizi')->constrained('program_kia_gizis')->onDelete('cascade');
            $table->string('namaKegiatan');
            $table->string('deskripsi');
            $table->integer('targetJumlahSetiapDesa');
            $table->integer('targetJumlahDesaMelaksanakan');
            $table->integer('targetBulanan');
            $table->integer('targetTriwulan');
            $table->integer('targetSemester');
            $table->integer('targetTahunan');
            $table->boolean('isActive')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan_program_kia_gizis');
    }
};
