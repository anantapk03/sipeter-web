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
        Schema::create('pencatatan_data_ukbm', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idDataUkbm')->references('id')->on('data_ukbm');
            $table->enum('bulan', ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12']);
            $table->integer('tahun');
            $table->string('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pencatatan_ukbm');
    }
};
