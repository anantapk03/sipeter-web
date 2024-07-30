<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataUkbm extends Model
{
    use HasFactory;

    protected $table = "data_ukbm";
    protected $primaryKey = "id";
    protected $fillable = [
        'idDesa',
        'idJenisUkbm',
        'namaUkbm',
        'alamatUkbm',
        'sumberPembiayaan',
        'kegiatanUkbm',
        'jumlahKader',
        'jumlahKaderDilatih',
        'status'
    ];
}
