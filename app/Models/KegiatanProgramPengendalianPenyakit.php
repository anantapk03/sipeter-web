<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanProgramPengendalianPenyakit extends Model
{
    use HasFactory;

    protected $table = 'kegiatan_program_pengendalian_penyakit';

    protected $fillable = [
        'idProgram',
        'namaKegiatan',
        'targetJumlah',
        'deskripsi',
        'isActive',
    ];

    public function programPengendalianPenyakit()
    {
        return $this->belongsTo(ProgramPengendalianPenyakit::class, 'idProgram');
    }
}
