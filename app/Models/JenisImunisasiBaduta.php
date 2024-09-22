<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisImunisasiBaduta extends Model
{
    use HasFactory;
    protected $table = 'jenis_imunisasi_baduta';

    protected $fillable = [
        'namaImunisasi',
        'deskripsi',
        'isActive',
    ];
}
