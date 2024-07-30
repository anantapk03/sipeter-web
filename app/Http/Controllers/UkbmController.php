<?php

namespace App\Http\Controllers;

use App\Models\JenisUkbm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UkbmController extends Controller
{
    public function index(){
        $data = JenisUkbm::all();
        $dataUkbm = DB::table('data_ukbm')
            ->leftJoin('wilayah_kerja', 'data_ukbm.idDesa', '=', 'wilayah_kerja.id')
            ->leftJoin('jenis_ukbm', 'data_ukbm.idJenisUkbm', '=', 'jenis_ukbm.id')
            ->select('wilayah_kerja.namaDesa', 'jenis_ukbm.jenisUkbm', 'data_ukbm.*')
            ->get();

        return view('admin.ukm-essensial.promkes.promkes-umum.ukbm.index', compact('data', 'dataUkbm'));
    }

    public function addJenisUkbm(){
        return view('admin.ukm-essensial.promkes.promkes-umum.ukbm.jenis-ukbm.create');
    }

    public function postJenisUkbm(Request $request){
        JenisUkbm::create([
            'jenisUkbm' => $request->jenisUkbm
        ]);
    
        return redirect()->route('ukbm.index');
    }

    public function editJenisUkbm(string $id){
        $data = JenisUkbm::findOrFail($id);
        return view('admin.ukm-essensial.promkes.promkes-umum.ukbm.jenis-ukbm.edit', compact('data'));
    }

    public function updateJenisUkbm(string $id, Request $request){
        $data = JenisUkbm::findOrFail($id);
        $data->jenisUkbm = $request->jenisUkbm;
        $data->update();

        return redirect()->route('ukbm.index');
    }

    public function deleteJenisUkbm(string $id){
        $data = JenisUkbm::findOrFail($id);
        $data->delete();

        return redirect()->route('ukbm.index');
    }
}
