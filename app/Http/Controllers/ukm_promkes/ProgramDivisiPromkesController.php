<?php

namespace App\Http\Controllers\ukm_promkes;

use App\Http\Controllers\Controller;
use App\Models\ProgramDivisiPromkes;
use Exception;
use Illuminate\Http\Request;

class ProgramDivisiPromkesController extends Controller
{
    public function index(){
        $data = ProgramDivisiPromkes::orderBy('isActive', 'desc')->get();
        return view('admin.ukm-essensial.promkes.index', ['data' => $data]);
    }

    public function create(){
        return view('admin.ukm-essensial.promkes.create');
    }

    public function store(Request $request){
        $data = new ProgramDivisiPromkes();

        $data->namaProgram = $request->namaProgram;
        $data->deskripsi= $request->deskripsi;
        $data->isActive = true;

        try{
            $data->save();
            $tag = "success";
            $message = "Data berhasil ditambahkan";
        } catch(Exception $e){
            $tag = "error";
            $message = $e->getMessage();
        }

        return redirect()->route('program-divisi-promosi-kesehatan')->with($tag, $message);

    }

    public function edit($id){
        $data = ProgramDivisiPromkes::find($id);
        return view('admin.ukm-essensial.promkes.update', ['data' => $data]);
    }

    public function update(Request $request, $id){
        
        $data = ProgramDivisiPromkes::find($id);

        $data->namaProgram = $request->namaProgram;
        $data->deskripsi= $request->deskripsi;
        // $data->isActive = $request->isActive;

        try{
            $data->update();
            $tag = "success";
            $message = "Data berhasil diperbarui";
        } catch(Exception $e){
            $tag = "error";
            $message = $e->getMessage();
        }

        return redirect()->route('program-divisi-promosi-kesehatan')->with($tag, $message);

    }

    public function updateStatus($id){
        $data = ProgramDivisiPromkes::find($id);
        if($data->isActive){
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
