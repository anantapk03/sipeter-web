<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramDivisi extends Model
{
    use HasFactory;

    protected $table = 'program_divisi';

    protected $fillable = ['idDivisi', 'namaProgram', 'isActive'];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'idDivisi');
    }
}
