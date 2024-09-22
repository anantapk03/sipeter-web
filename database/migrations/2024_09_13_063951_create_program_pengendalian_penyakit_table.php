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
        Schema::create('program_pengendalian_penyakit', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idCategory')->constrained('category_p2')->onDelete('cascade');
            $table->string('namaProgram');
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
        Schema::dropIfExists('program_pengendalian_penyakit');
    }
};
