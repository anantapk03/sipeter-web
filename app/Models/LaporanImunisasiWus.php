<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanImunisasiWus extends Model
{
    protected $table = 'laporan_imunisasi_wus';
    protected $primaryKey = 'id';
    protected $fillable = [
        'idSasaran',
        'idJenis',
        'jumlah'
    ];
    
    use HasFactory;
}
