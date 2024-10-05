<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListReportUksKiaGizi extends Model
{
    use HasFactory;

    protected $table = 'list_report_uks_kia_gizi';

    // Kolom yang bisa diisi secara massal
    protected $fillable = [
        'idReportByMonthGiziKia',
        'idReportItemUks',
    ];

        // Relasi dengan tabel report_by_month_gizi_kia
        public function reportByMonth()
        {
            return $this->belongsTo(ReportByMonthGiziKia::class, 'idReportByMonthGiziKia');
        }
    
        // Relasi dengan tabel pencatatan_kegiatan_program_kesehatan_sekolah
        public function reportItemUks()
        {
            return $this->belongsTo(PencatatanKegiatanProgramKesehatanSekolah::class, 'idReportItemUks');
        }
}
