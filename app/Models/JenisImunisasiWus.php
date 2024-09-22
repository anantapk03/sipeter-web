<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisImunisasiWus extends Model
{

    protected $table = 'jenis_imunisasi_wus';
    protected $primaryKey = 'id';
    protected $fillable = [
        'namaImunisasi',
        'deskripsi',
        'isActive'
    ];

    use HasFactory;
}
