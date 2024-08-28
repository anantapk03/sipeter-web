<?php

namespace App\Http\Controllers\ukm_kia_gizi;

use App\Http\Controllers\Controller;
use App\Models\KelasSiswa;
use Exception;
use Illuminate\Http\Request;

class KelasSiswaController extends Controller
{
    public function index(){
        $data = KelasSiswa::all();
        return view('admin.ukm-essensial.kia-gizi.kesehatan_sekolah.kelas.index', ['data' => $data]);
    }

    public function create(){
        return view('admin.ukm-essensial.kia-gizi.kesehatan_sekolah.kelas.create');
    }

    public function store(Request $request){
        $data = new KelasSiswa();
        $data->namaKelas = $request->namaKelas;
        $data->deskripsi = $request->deskripsi;

        try{
            $data->save();
            $tag = 'success';
            $message = 'Data berhasil ditambahkan';
        } catch(Exception $e){
            $tag = 'error';
            $message = $e->getMessage();
        }

        return redirect()->route('kegiatan-program-kia-gizi-UKS-kelas-siswa-index')->with($tag, $message);
    }

    public function edit($idKelas){
        try{
            $data = KelasSiswa::find($idKelas);
            return view('admin.ukm-essensial.kia-gizi.kesehatan_sekolah.kelas.update', ['data' => $data]);
        } catch(Exception $e){
            return redirect()->back()->with('error','Data tidak ditemukan');
        }
    }

    public function update(Request $request, $idKelas){
        try {
            $data =  KelasSiswa::find($idKelas);
        } catch (Exception $e) { 
            return redirect()->back()->with('error', $e->getMessage());
        }

        $data->namaKelas = $request->namaKelas;
        $data->deskripsi = $request->deskripsi;

        try{
            $data->update();
            $tag = 'success';
            $message = 'Data berhasil diperbarui';
        } catch(Exception $e){
            $tag = 'error';
            $message = $e->getMessage();
        }

        return redirect()->route('kegiatan-program-kia-gizi-UKS-kelas-siswa-index')->with($tag, $message);
    }
}
