<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PencatatanUkbm extends Model
{
    use HasFactory;

    protected $table = 'pencatatan_data_ukbm';
    protected $primaryKey = 'id';
    protected $fillable = [
        'idDataUkbm',
        'bulan',
        'tahun',
        'deskripsi'
    ];
}
