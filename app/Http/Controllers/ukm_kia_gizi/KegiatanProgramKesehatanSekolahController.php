<?php

namespace App\Http\Controllers\ukm_kia_gizi;

use App\Http\Controllers\Controller;
use App\Models\KegiatanProgramKesehatanSekolah;
use Exception;
use Illuminate\Http\Request;

class KegiatanProgramKesehatanSekolahController extends Controller
{
    public function index(){
        $data = KegiatanProgramKesehatanSekolah::all();
        return view('admin.ukm-essensial.kia-gizi.kesehatan_sekolah.index', ['data' => $data]);
    }

    public function create(){
        return view('admin.ukm-essensial.kia-gizi.kesehatan_sekolah.create');
    }

    public function store(Request $request){
        $data = new KegiatanProgramKesehatanSekolah();
        $data->namaKegiatan = $request->namaKegiatan;
        $data->deskripsi = $request->deskripsi;
        $data->targetBulanan = $request->targetBulanan;
        $data->targetTriwulan = $request->targetTriwulan;
        $data->targetSemester = $request->targetSemester;
        $data->targetTahunan = $request->targetTahunan;
        $data->isActive = true;

        try {
            $data->save();
            $tag = "success";
            $message = "Data berhasil ditambahkan";
        } catch (Exception $e) {
            $tag = "error";
            $message = "Data gagal ditambahkan";
        }
        return redirect()->route('kegiatan-program-kia-gizi-UKS-index')->with($tag, $message);
    }

    public function edit($id){
        try {
            $data = KegiatanProgramKesehatanSekolah::find($id);
        } catch (Exception $e) {
            return redirect()->back()->with('error','Data tidak ditemukan');
        }
        return view('admin.ukm-essensial.kia-gizi.kesehatan_sekolah.update', ['data' => $data]);
    }

    public function update(Request $request, $id){
        try {
            $data = KegiatanProgramKesehatanSekolah::find($id);
        } catch (Exception $e) {
            return redirect()->back()->with('error','Data tidak ditemukan');;
        }

        $data->namaKegiatan = $request->namaKegiatan;
        $data->deskripsi = $request->deskripsi;
        $data->targetBulanan = $request->targetBulanan;
        $data->targetTriwulan = $request->targetTriwulan;
        $data->targetSemester = $request->targetSemester;
        $data->targetTahunan = $request->targetTahunan;
        // $data->isActive = true;

        try {
            $data->update();
            $tag = "success";
            $message = "Data berhasil diperbarui";
        } catch (Exception $e) {
            $tag = "error";
            $message = "Data gagal diperbarui";
        }
        return redirect()->route('kegiatan-program-kia-gizi-UKS-index')->with($tag, $message);
    }

    public function updateStatus($id){
        $data = KegiatanProgramKesehatanSekolah::find($id);

        if($data != null){
            if($data->isActive){
                $data->isActive = false;
            } else{
                $data->isActive = true;
            }

            try{
                $data->update();
                $tag = 'success';
                $message = 'Status berhasil diperbarui';
            } catch(Exception $e){
                $tag = 'error';
                $message = 'Status gagal diperbarui';
            }

            return redirect()->back()->with($tag, $message);
        }

        return redirect()->back()->with('error', 'Data tidak ditemukan');
    }


}
