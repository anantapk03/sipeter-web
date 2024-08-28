<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengendalianPenyakitController extends Controller
{
    public function menu(){
        return view('admin.ukm-essensial.pengendalian-penyakit.index');
    }

    public function imunisasi(){
        return view('admin.ukm-essensial.pengendalian-penyakit.imunisasi.index');
    }
}
