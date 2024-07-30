<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PencatatanKegiatanPromkesDesa extends Model
{
    use HasFactory;

    protected $table = 'pencatatan_kegiatan_promkes_desa';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'idKegiatanPromkesDesa',
        'idDesa',
        'jumlah',
        'bulan',
        'tahun',
    ];
}
