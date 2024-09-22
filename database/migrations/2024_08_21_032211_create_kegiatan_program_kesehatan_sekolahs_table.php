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
        Schema::create('kegiatan_program_kesehatan_sekolahs', function (Blueprint $table) {
            $table->id();
            $table->string('namaKegiatan');
            $table->text('deskripsi')->nullable();
            $table->integer('targetBulanan')->nullable();
            $table->integer('targetTriwulan')->nullable();
            $table->integer('targetSemester')->nullable();
            $table->integer('targetTahunan')->nullable();
            $table->boolean('isActive')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan_program_kesehatan_sekolahs');
    }
};
