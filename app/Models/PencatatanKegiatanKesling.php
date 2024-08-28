<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PencatatanKegiatanKesling extends Model
{
    use HasFactory;
    protected $table = 'pencatatan_data_kesling';
    protected $primaryKey = 'id';
    protected $fillable = [
        'idKegiatanKesling',
        'jumlah',
        'deskripsi',
        'bulan',
        'tahun'
    ];
}
