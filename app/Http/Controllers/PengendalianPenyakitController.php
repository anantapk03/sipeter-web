<?php

namespace App\Http\Controllers;

use App\Models\CategoryP2;
use Illuminate\Http\Request;

class PengendalianPenyakitController extends Controller
{
    public function menu(){
        $data = CategoryP2::where('isActive',true)->get();
        return view('admin.ukm-essensial.pengendalian-penyakit.index', ['data' => $data]);
    }

    public function imunisasi(){
        return view('admin.ukm-essensial.pengendalian-penyakit.imunisasi.index');
    }
}
