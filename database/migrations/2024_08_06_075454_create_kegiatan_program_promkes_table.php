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
        Schema::create('kegiatan_program_promkes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idProgram');
            $table->string('namaKegiatan');
            $table->text('deskripsi')->nullable();
            $table->integer('targetBulanan')->default(0);
            $table->integer('targetTriwulan')->default(0);
            $table->integer('targetSemester')->default(0);
            $table->integer('targetTahunan')->default(0);
            $table->boolean('isActive')->default(true);
            $table->timestamps();

            $table->foreign('idProgram')->references('id')->on('program_divisi_promkes')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan_program_promkes');
    }
};
