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
        Schema::create('program_divisi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idDivisi')
                ->constrained('divisi')
                ->onDelete('cascade');
            $table->string('namaProgram');
            $table->boolean('isActive')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_divisi');
    }
};