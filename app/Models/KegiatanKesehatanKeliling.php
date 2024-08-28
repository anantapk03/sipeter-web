<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanKesehatanKeliling extends Model
{
    use HasFactory;
    protected $table = 'kegiatan_kesling';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kegiatan',
        'deskripsi',
        'bulanan',
        'triwulan',
        'semester',
        'tahunan',
        'status'
    ];
}
