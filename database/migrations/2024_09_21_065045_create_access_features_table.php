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
        Schema::create('access_features', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idDivisi')
                ->constrained('divisi')
                ->onDelete('cascade');
            $table->foreignId('idUser')
                ->constrained('users')
                ->onDelete('cascade');
            $table->boolean('isLeader')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('access_features');
    }
};
