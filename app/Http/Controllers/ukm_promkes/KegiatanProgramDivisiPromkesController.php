<?php

namespace App\Http\Controllers\ukm_promkes;

use App\Http\Controllers\Controller;
use App\Models\KegiatanProgramPromkes;
use App\Models\ProgramDivisiPromkes;
use Exception;
use Illuminate\Http\Request;

class KegiatanProgramDivisiPromkesController extends Controller
{
    public function index($id){
        $dataProgram = ProgramDivisiPromkes::find($id);
        $data = KegiatanProgramPromkes::where('idProgram', $id)->get();
        return view('admin.ukm-essensial.promkes.promkes-other.index', ['dataProgram' => $dataProgram, 'data' => $data]);
    }

    public function create($id){
        $dataProgram = ProgramDivisiPromkes::find($id);
        return view('admin.ukm-essensial.promkes.promkes-other.create', ['dataProgram' => $dataProgram]);
    }

    public function store($id, Request $request){
        $data = new KegiatanProgramPromkes();

        $data->namaKegiatan = $request->namaKegiatan;
        $data->deskripsi = $request->deskripsi;
        $data->isActive = true;
        $data->targetBulanan = $request->targetBulanan;
        $data->targetTriwulan = $request->targetTriwulan;
        $data->targetSemester = $request->targetSemester;
        $data->targetTahunan = $request->targetTahunan;
        $data->idProgram = $id;
        try{
            $data->save();
            $tag = "success";
            $message= "Data berhasil ditambahkan";
        } catch(Exception $e){
            $tag = "error";
            $message = $e->getMessage();
        }

        return redirect()->route('kegiatan-program-divisi-promkes-index', ['id' => $id])->with($tag, $message);
    }

    public function edit($id, $idKegiatan ){
        $dataProgram = ProgramDivisiPromkes::find($id);
        $data = KegiatanProgramPromkes::find($idKegiatan);
        // dd($data);
        return view('admin.ukm-essensial.promkes.promkes-other.update', ['dataProgram' => $dataProgram, 'data'=>$data]);
    }

    public function update($id, $idKegiatan, Request $request){
        $data = KegiatanProgramPromkes::find($idKegiatan);

        $data->namaKegiatan = $request->namaKegiatan;
        $data->deskripsi = $request->deskripsi;
        $data->targetBulanan = $request->targetBulanan;
        $data->targetTriwulan = $request->targetTriwulan;
        $data->targetSemester = $request->targetSemester;
        $data->targetTahunan = $request->targetTahunan;
        try{
            $data->update();
            $tag = "success";
            $message= "Data berhasil diperbarui";
        } catch(Exception $e){
            $tag = "error";
            $message = $e->getMessage();
        }

        return redirect()->route('kegiatan-program-divisi-promkes-index', ['id' => $id])->with($tag, $message);
    }

    public function updateStatus($id, $idKegiatan){
        $data = KegiatanProgramPromkes::find($idKegiatan);
        
        if($data->isActive){
            $data->isActive = false;
        } else{
            $data->isActive = true;
        }

        try{
            $data->update();
            $tag = "success";
            $message= "Data berhasil diperbarui";
        } catch(Exception $e){
            $tag = "error";
            $message = $e->getMessage();
        }

        return redirect()->back()->with($tag, $message);
    
    }


}
