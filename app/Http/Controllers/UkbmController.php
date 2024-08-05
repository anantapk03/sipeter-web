<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\JenisUkbm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UkbmController extends Controller
{
    public function index(){

        $data = JenisUkbm::all();
        return view('admin.ukm-essensial.promkes.promkes-umum.ukbm.jenis-ukbm.index', compact('data'));

    }

    public function addJenisUkbm(){
        return view('admin.ukm-essensial.promkes.promkes-umum.ukbm.jenis-ukbm.create');
    }

    public function postJenisUkbm(Request $request){
        JenisUkbm::create([
            'jenisUkbm' => $request->jenisUkbm,
            'bulanan' => $request->bulanan,
            'triwulan' => $request->triwulan,
            'semester' => $request->semester,
            'tahunan' => $request->tahunan
        ]);

        try{
            $tag= "success";
            $message = "Data berhasil ditambahkan";
        } catch(Exception $e) {
            $tag = "error";
            $message = $e->getMessage();
        }
    
        return redirect()->route('ukbm.jenis.index')->with($tag, $message);
    }

    public function editJenisUkbm(string $id){
        $data = JenisUkbm::findOrFail($id);
        return view('admin.ukm-essensial.promkes.promkes-umum.ukbm.jenis-ukbm.edit', compact('data'));
    }

    public function updateJenisUkbm(string $id, Request $request){
        $data = JenisUkbm::findOrFail($id);
        $data->jenisUkbm = $request->jenisUkbm;
        $data->bulanan = $request->bulanan;
        $data->triwulan = $request->triwulan;
        $data->semester = $request->semester;
        $data->tahunan = $request->tahunan;
        
        try{
            $data->update();
            $tag= "success";
            $message = "Data berhasil diperbarui";
        } catch(Exception $e) {
            $tag = "error";
            $message = $e->getMessage();
        }

        return redirect()->route('ukbm.jenis.index')->with($tag, $message);
    }

    public function deleteJenisUkbm(string $id){
        $data = JenisUkbm::findOrFail($id);
        $data->delete();

        return redirect()->route('ukbm.jenis.index');
    }
}
