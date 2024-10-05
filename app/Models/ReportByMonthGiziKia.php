<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportByMonthGiziKia extends Model
{
    use HasFactory;
    protected $table = 'report_by_month_gizi_kia';

    // Kolom yang bisa diisi secara massal
    protected $fillable = [
        'isAcceptedByPetugas',
        'isAcceptedByKepus',
        'bulan',
        'tahun',
    ];

        // Relasi dengan tabel list_report_kia_gizi
        public function listReportKiaGizi()
        {
            return $this->hasMany(ListReportKiaGizi::class, 'idReportByMonthGiziKia');
        }
    
        // Relasi dengan tabel list_report_uks_kia_gizi
        public function listReportUksKiaGizi()
        {
            return $this->hasMany(ListReportUksKiaGizi::class, 'idReportByMonthGiziKia');
        }

}
