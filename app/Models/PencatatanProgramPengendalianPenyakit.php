<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PencatatanProgramPengendalianPenyakit extends Model
{
    use HasFactory;

    protected $table = 'pencatatan_program_pengendalian_penyakit';

    protected $fillable = [
        'idKegiatan',
        'jumlah',
        'bulan',
        'tahun',
        'deskripsi',
    ];

    public function kegiatanProgramPengendalianPenyakit()
    {
        return $this->belongsTo(KegiatanProgramPengendalianPenyakit::class, 'idKegiatan');
    }
}
