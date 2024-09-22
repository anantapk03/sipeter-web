<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanProgramKiaGizi extends Model
{
    use HasFactory;

    protected $table = 'kegiatan_program_kia_gizis';

    protected $fillable = [
        'idProgramKiaGizi',
        'namaKegiatan',
        'deskripsi',
        'targetJumlahSetiapDesa',
        'targetJumlahDesaMelaksanakan',
        'targetBulanan',
        'targetTriwulan',
        'targetSemester',
        'targetTahunan',
        'isActive',
    ];

    public function programKiaGizi()
    {
        return $this->belongsTo(ProgramKiaGizi::class, 'idProgramKiaGizi');
    }
}
