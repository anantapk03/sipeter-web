<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryP2 extends Model
{
    use HasFactory;

    protected $table = 'category_p2';

    protected $fillable = [
        'namaCategory',
        'deskripsi',
        'isActive',
    ];

}
