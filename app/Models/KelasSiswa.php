<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasSiswa extends Model
{
    use HasFactory;

    protected $table = 'kelas_siswas';

    protected $fillable = [
        'namaKelas',
        'deskripsi',
    ];

    public function pencatatanKegiatan()
    {
        return $this->hasMany(PencatatanKegiatanProgramKesehatanSekolah::class, 'idKelasSiswa');
    }
}
