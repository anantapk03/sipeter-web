<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessFeature extends Model
{
    use HasFactory;

    protected $fillable = [
        'idDivisi',
        'idUser',
        'isLeader',
    ];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'idDivisi');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }
}
