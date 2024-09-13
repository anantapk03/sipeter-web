<?php

namespace App\Http\Controllers\ukm_p2;

use App\Http\Controllers\Controller;
use App\Models\ProgramPengendalianPenyakit;
use Exception;
use Illuminate\Http\Request;

class LaporanKegiatanProgramP2Controller extends Controller
{

    public function findProgram($id){
        try{
            $data = ProgramPengendalianPenyakit::findOrFail($id);
            return $data;
        } catch(Exception $e){
            return null;
        }
    }

    public function index($id){
        $program = $this->findProgram($id);
        if(!$program){
            return redirect()->back()->with('error', 'Program not found');
        }
        return view('admin.ukm-essensial.pengendalian-penyakit.category_p2.program.laporan.index', ['program'=>$program]);
    }
}
