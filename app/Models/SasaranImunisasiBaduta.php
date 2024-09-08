<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SasaranImunisasiBaduta extends Model
{
    use HasFactory;
    protected $table = 'sasaran_imunisasi_baduta';

    protected $fillable = [
        'idDesa',
        'sasaran_laki',
        'sasaran_perempuan',
        'bulan',
        'tahun',
        'deskripsi',
    ];

    // Relasi dengan model Desa (wilayah_kerja)
    public function desa()
    {
        return $this->belongsTo(Desa::class, 'idDesa');
    }
}
