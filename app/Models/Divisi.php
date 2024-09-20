<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;

    protected $table = 'divisi';

    protected $fillable = ['namaDivisi', 'isActive'];

    public function programDivisi()
    {
        return $this->hasMany(ProgramDivisi::class, 'idDivisi');
    }
}
