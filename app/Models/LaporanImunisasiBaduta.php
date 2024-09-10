<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanImunisasiBaduta extends Model
{
    use HasFactory;

    protected $table = 'laporan_imunisasi_baduta';

    protected $fillable = [
        'idSasaranImunisasi',
        'idJenisImunisasi',
        'jumlah_laki',
        'jumlah_perempuan',
        'deskripsi',
    ];

    public function sasaranImunisasi()
    {
        return $this->belongsTo(SasaranImunisasiBaduta::class, 'idSasaranImunisasi');
    }

    public function jenisImunisasi()
    {
        return $this->belongsTo(JenisImunisasiBaduta::class, 'idJenisImunisasi');
    }
}
