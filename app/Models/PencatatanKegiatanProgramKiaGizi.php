<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PencatatanKegiatanProgramKiaGizi extends Model
{
    use HasFactory;

    protected $table = 'pencatatan_kegiatan_program_kia_gizis';

    protected $fillable = [
        'idKegiatanProgramKiaGizi',
        'idDesa',
        'bulan',
        'tahun',
        'jumlah',
        'deskripsi',
    ];

    public function kegiatanProgramKiaGizi()
    {
        return $this->belongsTo(KegiatanProgramKiaGizi::class, 'idKegiatanProgramKiaGizi');
    }

    public function wilayahKerja()
    {
        return $this->belongsTo(Desa::class, 'idDesa');
    }
}
