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
        Schema::create('kegiatan_promosi_kesehatan_umum_desa', function (Blueprint $table) {
            $table->id('id')->autoIncrement();
            $table->string('namaKegiatan');
            $table->text('deskripsiKegiatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan_kesehatan_umum_desa');
    }
};
