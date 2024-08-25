<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanProgramKesehatanSekolah extends Model
{
    use HasFactory;

    protected $table = 'kegiatan_program_kesehatan_sekolahs';

    protected $fillable = [
        'namaKegiatan',
        'deskripsi',
        'targetBulanan',
        'targetTriwulan',
        'targetSemester',
        'targetTahunan',
        'isActive',
    ];

    /**
     * Relasi ke model PencatatanKegiatanProgramKesehatanSekolah
     */
    public function pencatatanKegiatan()
    {
        return $this->hasMany(PencatatanKegiatanProgramKesehatanSekolah::class, 'idKegiatanProgramKesehatanSekolah');
    }
}
