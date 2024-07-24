<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKegiatanPromosiKesehatanDesa extends Model
{
    use HasFactory;
    protected $table = 'kegiatan_promosi_kesehatan_umum_desa';
    protected $primaryKey = 'id';
    protected $fillable = [
        'namaKegiatan',
        'deskripsiKegiatan',
    ];
}
