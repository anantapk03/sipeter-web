<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramPengendalianPenyakit extends Model
{
    use HasFactory;

    protected $table = 'program_pengendalian_penyakit';

    protected $fillable = [
        'idCategory',
        'namaProgram',
        'deskripsi',
        'isActive',
    ];

    public function categoryP2()
    {
        return $this->belongsTo(CategoryP2::class, 'idCategory');
    }

}
