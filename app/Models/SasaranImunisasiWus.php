<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SasaranImunisasiWus extends Model
{
    protected $table = 'sasaran_imunisasi_wus';
    protected $primaryKey = 'id';
    protected $fillable = [
        'idDesa',
        'jumlahSasaran'
    ];
    
    use HasFactory;
}
