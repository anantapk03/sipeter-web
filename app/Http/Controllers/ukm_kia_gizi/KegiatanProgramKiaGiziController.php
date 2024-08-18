<?php

namespace App\Http\Controllers\ukm_kia_gizi;

use App\Http\Controllers\Controller;
use App\Models\KegiatanProgramKiaGizi;
use App\Models\ProgramKiaGizi;
use Exception;
use Illuminate\Http\Request;

class KegiatanProgramKiaGiziController extends Controller
{
    public function index($id){
        $dataProgram = ProgramKiaGizi::find($id);
        $data = KegiatanProgramKiaGizi::where('idProgramKiaGizi', $id)->get();
        return view('admin.ukm-essensial.kia-gizi.kegiatan.index', ['data' => $data, 'dataProgram'=>$dataProgram]);
    }

    public function create($id){
        $dataProgram = ProgramKiaGizi::find($id);
        return view('admin.ukm-essensial.kia-gizi.kegiatan.create', ['dataProgram'=>$dataProgram]);
    }

    public function store($id, Request $request){
        $data = new KegiatanProgramKiaGizi();

        $data->namaKegiatan = $request->namaKegiatan;
        $data->deskripsi = $request->deskripsi;
        $data->idProgramKiaGizi = $id;
        $data->targetJumlahDesaMelaksanakan = $request->targetJumlahDesaMelaksanakan;
        $data->targetJumlahSetiapDesa = $request->targetJumlahSetiapDesa;
        $data->targetBulanan = $request->targetBulanan;
        $data->targetTriwulan = $request->targetTriwulan;
        $data->targetSemester = $request->targetSemester;
        $data->targetTahunan = $request->targetTahunan;
        $data->isActive = true;


        try{
            $data->save();
            $tag = "success";
            $message = "Data berhasil ditambahkan";
        } catch(Exception $e){
            $tag = "error";
            $message = $e->getMessage();
        }

        return redirect()->route('kegiatan-program-kia-gizi-index', ['id' =>$id])->with($tag, $message);
    }

    public function edit($id, $idKegiatan){
        $dataProgram = ProgramKiaGizi::find($id);
        $data = KegiatanProgramKiaGizi::find($idKegiatan);
        return view('admin.ukm-essensial.kia-gizi.kegiatan.update', ['dataProgram'=>$dataProgram, 'data'=>$data]);
    }

    public function update($id, $idKegiatan, Request $request){
        $data =  KegiatanProgramKiaGizi::find($idKegiatan);

        $data->namaKegiatan = $request->namaKegiatan;
        $data->deskripsi = $request->deskripsi;
        $data->idProgramKiaGizi = $id;
        $data->targetJumlahDesaMelaksanakan = $request->targetJumlahDesaMelaksanakan;
        $data->targetJumlahSetiapDesa = $request->targetJumlahSetiapDesa;
        $data->targetBulanan = $request->targetBulanan;
        $data->targetTriwulan = $request->targetTriwulan;
        $data->targetSemester = $request->targetSemester;
        $data->targetTahunan = $request->targetTahunan;


        try{
            $data->update();
            $tag = "success";
            $message = "Data berhasil diperbarui";
        } catch(Exception $e){
            $tag = "error";
            $message = $e->getMessage();
        }

        return redirect()->route('kegiatan-program-kia-gizi-index', ['id' =>$id])->with($tag, $message);
    }

    public function updateStatus($idKegiatan){
        $data =  KegiatanProgramKiaGizi::find($idKegiatan);

        if($data->isActive){
            $data->isActive = false;
        } else {
            $data->isActive = true;
        }

        try{
            $data->update();
            $tag = "success";
            $message = "Data berhasil diperbarui";
        } catch(Exception $e){
            $tag = "error";
            $message = $e->getMessage();
        }

        return redirect()->back()->with($tag, $message);
    }

}
