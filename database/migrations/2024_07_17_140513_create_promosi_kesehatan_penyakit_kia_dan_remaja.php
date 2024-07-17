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
        Schema::create('promosi_kesehatan_penyakit_kia_dan_remaja', function (Blueprint $table) {
            $table->id();
            $table->string('namaKegiatan');
            $table->text('deskripsiKegiatan');
            $table->string('jumlahKegiatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promosi_kesehatan_penyakit_kia_dan_remaja');
    }
};
