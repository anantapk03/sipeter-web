<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SasaranImunisasiBayi extends Model
{
    use HasFactory;

    protected $table = 'sasaran_imunisasi_bayi';

    protected $fillable = [
        'idDesa',
        'jumlah_sasaran_bayi_laki',
        'jumlah_sasaran_bayi_perempuan',
        'jumlah_surviving_infant_laki',
        'jumlah_surviving_infant_perempuan',
        'bulan',
        'tahun',
    ];
    

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'idDesa');

    }
}
