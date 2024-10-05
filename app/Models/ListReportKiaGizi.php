<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListReportKiaGizi extends Model
{
    use HasFactory;
    protected $table = 'list_report_kia_gizi';

    // Kolom yang bisa diisi secara massal
    protected $fillable = [
        'idReportByMonthGiziKia',
        'idReportItemKiaGizi',
    ];

    // Relasi dengan tabel report_by_month_gizi_kia
    public function reportByMonth()
    {
        return $this->belongsTo(ReportByMonthGiziKia::class, 'idReportByMonthGiziKia');
    }

    // Relasi dengan tabel pencatatan_kegiatan_program_kia_gizi
    public function reportItemKiaGizi()
    {
        return $this->belongsTo(PencatatanKegiatanProgramKiaGizi::class, 'idReportItemKiaGizi');
    }
}
