<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PencatatanKegiatanProgramKesehatanSekolah extends Model
{
    use HasFactory;

    protected $table = 'pencatatan_kegiatan_program_kesehatan_sekolahs';

    protected $fillable = [
        'idKegiatanProgramKesehatanSekolah',
        'idKelasSiswa',
        'bulan',
        'tahun',
        'jumlah',
        'deskripsi',
    ];

     /**
     * Relasi ke model KegiatanProgramKesehatanSekolah
     */
    public function kegiatanProgramKesehatanSekolah()
    {
        return $this->belongsTo(KegiatanProgramKesehatanSekolah::class, 'idKegiatanProgramKesehatanSekolah');
    }

    /**
     * Relasi ke model KelasSiswa
     */
    public function kelasSiswa()
    {
        return $this->belongsTo(KelasSiswa::class, 'idKelasSiswa');
    }
}
