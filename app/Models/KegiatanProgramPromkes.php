<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanProgramPromkes extends Model
{
    use HasFactory;

    protected $table = 'kegiatan_program_promkes';

    protected $fillable = [
        'idProgram',
        'namaKegiatan',
        'deskripsi',
        'targetBulanan',
        'targetTriwulan',
        'targetSemester',
        'targetTahunan',
        'isActive',
    ];

    public function program()
    {
        return $this->belongsTo(ProgramDivisiPromkes::class, 'idProgram');
    }
}
