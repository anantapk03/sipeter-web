<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanImunisasiBayi extends Model
{
    use HasFactory;

    protected $table = 'laporan_imunisasi_bayi';

    protected $fillable = [
        'idJenisImunisasi',
        'idSasaran',
        'jumlah_laki',
        'jumlah_perempuan',
        'deskripsi',
    ];

    public function jenisImunisasi()
    {
        return $this->belongsTo(JenisImunisasiBayi::class, 'idJenisImunisasi');
    }

    public function sasaranImunisasi()
    {
        return $this->belongsTo(SasaranImunisasiBayi::class, 'idSasaran');
    }
}
