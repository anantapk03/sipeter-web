<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramDivisiPromkes extends Model
{
    use HasFactory;

    protected $table = 'program_divisi_promkes';

    protected $fillable = [
        'namaProgram',
        'deskripsi',
        'isActive',
    ];

}
