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
        Schema::create('program_kesehatan_lingkungan', function (Blueprint $table) {
            $table->id('id')->autoIncrement();
            $table->string('namaProgram');
            $table->integer('targetJumlahPemeriksaan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_kesehatan_lingkungan');
    }
};
