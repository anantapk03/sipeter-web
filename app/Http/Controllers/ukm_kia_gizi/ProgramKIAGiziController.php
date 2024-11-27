<?php

namespace App\Http\Controllers\ukm_kia_gizi;

use App\Http\Controllers\Controller;
use App\Models\ProgramKiaGizi;
use Exception;
use Illuminate\Http\Request;

class ProgramKIAGiziController extends Controller
{
    public function index(){
        $data = ProgramKiaGizi::orderBy('isActive', 'desc')->get();
        return view('admin.ukm-essensial.kia-gizi.index', ['data' => $data]);
    }

    public function create(){
        return view('admin.ukm-essensial.kia-gizi.create');
    }

    public function store(Request $request){
        $data = new ProgramKiaGizi();
        $data->namaProgram = $request->namaProgram;
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
        
        return redirect()->route('program-kia-gizi-index')->with($tag, $message);
    }

    public function edit($id){
        $data = ProgramKiaGizi::find($id);
        return view('admin.ukm-essensial.kia-gizi.update', ['data' => $data]);
    }

    public function update($id, Request $request){
        $data = ProgramKiaGizi::find($id);

        $data->namaProgram = $request->namaProgram;
        $data->deskripsi = $request->deskripsi;

        try{
            $data->update();
            $tag = 'success';
            $message = 'Data berhasil diperbarui';
        } catch(Exception $e){
            $tag = 'error';
            $message = $e->getMessage();
        }
        
        return redirect()->route('program-kia-gizi-index')->with($tag, $message);
    }

    public function updateStatus($id){
        $data = ProgramKiaGizi::find($id);

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
        
        return redirect()->back()->with($tag, $message);
    }


}
