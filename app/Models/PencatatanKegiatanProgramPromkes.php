<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PencatatanKegiatanProgramPromkes extends Model
{
    use HasFactory;
    protected $table = 'pencatatan_kegiatan_program_promkes';

    protected $fillable = [
        'idKegiatanProgramPromkes',
        'jumlah',
        'deskripsi',
        'bulan',
        'tahun',
    ];

    public function kegiatanProgram()
    {
        return $this->belongsTo(KegiatanProgramPromkes::class, 'idKegiatanProgramPromkes');
    }
}
