<?php

namespace App\Http\Controllers\ukm_imunisasi\baduta;

use App\Http\Controllers\Controller;
use App\Models\JenisImunisasiBaduta;
use Exception;
use Illuminate\Http\Request;

class JenisImunisasiBadutaController extends Controller
{
    public function index(){
        $data = JenisImunisasiBaduta::all();
        return view('admin.ukm-essensial.pengendalian-penyakit.imunisasi.baduta.jenis_imunisasi.index', ['data'=>$data]);
    }

    public function create(){
        return view('admin.ukm-essensial.pengendalian-penyakit.imunisasi.baduta.jenis_imunisasi.create');
    }

    public function store(Request $request){
        $data = new JenisImunisasiBaduta();
        $data->namaImunisasi = $request->namaImunisasi;
        $data->deskripsi = $request->deskripsi;
        $data->isActive = true;

        try{
            $data->save();
            $tag = "success";
            $message = "Data berhasil ditambahkan";
        } catch(Exception $e){
            $tag = "error";
            $message = $e->getMessage();
        }

        return redirect()->route('jenis-imunisasi-baduta-index')->with($tag, $message);
    }

    public function edit($id){
        try{
            $data = JenisImunisasiBaduta::findOrFail($id);
        } catch(Exception){
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        return view('admin.ukm-essensial.pengendalian-penyakit.imunisasi.baduta.jenis_imunisasi.edit', ['data'=>$data]);
    }

    public function update(Request $request, $id){
        try{
            $data = JenisImunisasiBaduta::findOrFail($id);
        } catch(Exception){
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $data->namaImunisasi = $request->namaImunisasi;
        $data->deskripsi = $request->deskripsi;

        try{
            $data->update();
            $tag = "success";
            $message = "Data berhasil diperbarui";
        } catch(Exception $e){
            $tag = "error";
            $message = $e->getMessage();
        }

        return redirect()->route('jenis-imunisasi-baduta-index')->with($tag, $message);
    }

    public function updateStatus(Request $request, $id){
        try{
            $data = JenisImunisasiBaduta::findOrFail($id);
        } catch(Exception){
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        if($data->isActive == true){
            $data->isActive = false; 
        } else{
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
