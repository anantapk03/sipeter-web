<?php

namespace App\Http\Controllers\ukm_imunisasi\imunisasi_bayi;

use App\Http\Controllers\Controller;
use App\Models\JenisImunisasiBayi;
use Exception;
use Illuminate\Http\Request;

class JenisImunisasiBayiController extends Controller
{
    public function index(){
        try{
            $data = JenisImunisasiBayi::all();
        } catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
        return view('admin.ukm-essensial.pengendalian-penyakit.imunisasi.imunisasi_bayi.jenis_imunisasi.index', ['data' => $data]);
    }

    public function create(){
        return view('admin.ukm-essensial.pengendalian-penyakit.imunisasi.imunisasi_bayi.jenis_imunisasi.create');
    }

    public function store(Request $request){
        $data = new JenisImunisasiBayi();

        $data->namaImunisasi = $request->namaImunisasi;
        $data->deskripsi = $request->deskripsi;
        $data->isActive = true;

        try{
            $data->save();
            $tag = 'success';
            $message = 'Data berhasil ditambahkan';
        } catch(Exception $e){
            $tag = 'error';
            $message = $e->getMessage();
        }

        return redirect()->route('pengendalian-penyakit-imunisai-imunisasi_bayi-jenis-index')->with($tag, $message);
    }

    public function edit($id){
        try {
            $data = JenisImunisasiBayi::findOrFail($id);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        return view('admin.ukm-essensial.pengendalian-penyakit.imunisasi.imunisasi_bayi.jenis_imunisasi.edit', ['data'=>$data]);
    }

    public function update($id, Request $request){
        try {
            $data = JenisImunisasiBayi::findOrFail($id);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $data->namaImunisasi = $request->namaImunisasi;
        $data->deskripsi = $request->deskripsi;

        try{
            $data->update();
            $tag = 'success';
            $message = 'Data berhasil diperbarui';
        } catch(Exception $e){
            $tag = 'error';
            $message = $e->getMessage();
        }

        return redirect()->route('pengendalian-penyakit-imunisai-imunisasi_bayi-jenis-index')->with($tag, $message);
    }

    public function updateStatus($id){
        try {
            $data = JenisImunisasiBayi::findOrFail($id);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        if($data->isActive){
            $data->isActive = false;
        } else{
            $data->isActive = true;
        }

        try{
            $data->update();
            $tag = 'success';
            $message = 'Data berhasil diperbarui';
        } catch(Exception $e){
            $tag = 'error';
            $message = $e->getMessage();
        }

        return redirect()->route('pengendalian-penyakit-imunisai-imunisasi_bayi-jenis-index')->with($tag, $message);

    }
}
