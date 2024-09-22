<?php

namespace App\Http\Controllers;

use App\Models\CategoryP2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengendalianPenyakitController extends Controller
{
    public function menu(){
        $data = CategoryP2::where('isActive',true)->get();
        return view('admin.ukm-essensial.pengendalian-penyakit.index', ['data' => $data]);
    }

    public function imunisasi(){
        return view('admin.ukm-essensial.pengendalian-penyakit.imunisasi.index');
    }

    public function imunisasi_wus(){
        $data = DB::table('sasaran_imunisasi_wus')
            ->leftJoin('wilayah_kerja', 'sasaran_imunisasi_wus.idDesa', '=', 'wilayah_kerja.id')
            ->select('wilayah_kerja.namaDesa', 'sasaran_imunisasi_wus.*')
            ->get();

        #dd($data);
        return view('admin.ukm-essensial.pengendalian-penyakit.imunisasi.imunisasi-wus.index', compact('data'));
    }
}
