<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramKiaGizi extends Model
{
    use HasFactory;
    protected $table = 'program_kia_gizis';

    protected $fillable = [
        'namaProgram',
        'deskripsi',
        'isActive',
    ];
}
