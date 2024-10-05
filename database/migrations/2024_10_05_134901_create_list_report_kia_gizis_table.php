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
    Schema::create('list_report_kia_gizi', function (Blueprint $table) {
        $table->id();
        $table->foreignId('idReportByMonthGiziKia')->constrained('report_by_month_gizi_kia')->onDelete('cascade');
        $table->foreignId('idReportItemKiaGizi')->constrained('pencatatan_kegiatan_program_kia_gizis')->onDelete('cascade');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_report_kia_gizi');
    }
};
