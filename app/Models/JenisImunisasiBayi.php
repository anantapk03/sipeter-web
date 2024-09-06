<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisImunisasiBayi extends Model
{
    use HasFactory;
    protected $table = 'jenis_imunisasi_bayi';

    protected $fillable = [
        'namaImunisasi',
        'deskripsi',
        'isActive',
    ];
}
