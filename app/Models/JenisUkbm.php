<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisUkbm extends Model
{
    use HasFactory;
    protected $table = 'jenis_ukbm';
    protected $primarykey = 'id';
    protected $fillable = [
        'jenisUkbm',
        'bulanan',
        'triwulan',
        'semester',
        'tahunan'
    ];
}
