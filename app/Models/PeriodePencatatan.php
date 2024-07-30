<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodePencatatan extends Model
{
    use HasFactory;

    protected $table = 'periode_pencatatan';
    protected $primaryKey = 'id';
    protected $fillable = ['bulan', 'tahun', 'is_disabled'];
}
