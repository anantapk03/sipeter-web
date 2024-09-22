<?php

namespace App\Http\Controllers\ukm_p2;

use App\Http\Controllers\Controller;
use App\Models\KegiatanProgramPengendalianPenyakit;
use App\Models\ProgramPengendalianPenyakit;
use Exception;
use Illuminate\Http\Request;

class KegiatanProgramP2Controller extends Controller
{

    public function findProgram($id){
        try{
            $data = ProgramPengendalianPenyakit::findOrFail($id);
            return $data;
        } catch(Exception $e){
            return null;
        }
    }

    public function getKegiatan($idKegiatan){
        try{
            $data = KegiatanProgramPengendalianPenyakit::findOrFail($idKegiatan);
            return $data;
        } catch(Exception $e){
            return null;
        }
    }

    public function index($id){
        $program = $this->findProgram($id);
        if(!$program){
            return redirect()->back()->with('error', 'Program not found');
        }

        try{
            $data = KegiatanProgramPengendalianPenyakit::where('idProgram', $id)->get();
        } catch(Exception $e){
            return redirect()->back()->with('error', 'Something went wrong');
        }

        return view('admin.ukm-essensial.pengendalian-penyakit.category_p2.program.kegiatan.index', ['data' => $data, 'program' => $program]);
    }

    public function create($id){
        $program = $this->findProgram($id);
        if(!$program){
            return redirect()->back()->with('error', 'Program not found');
        }

        return view('admin.ukm-essensial.pengendalian-penyakit.category_p2.program.kegiatan.create', ['program'=>$program]);
    }

    public function store($id, Request $request){
        $program = $this->findProgram($id);
        if(!$program){
            return redirect()->back()->with('error', 'Program not found');
        }

        $data = new KegiatanProgramPengendalianPenyakit();

        $data->idProgram = $id;
        $data->namaKegiatan = $request->namaKegiatan;
        $data->targetJumlah = $request->targetJumlah;
        $data->deskripsi = $request->deskripsi;
        $data->isActive = true;

        try{
            $data->save();
            $tag = 'success';
            $message = 'Data saved successfully';
        } catch(Exception $e) {
            $tag = 'error';
            $message = $e->getMessage();
        }

        return redirect()->route('kegiatan-p2-index', ['id'=>$id])->with($tag, $message);

    }

    public function edit($id, $idKegiatan){
        $program = $this->findProgram($id);
        if(!$program){
            return redirect()->back()->with('error', 'Program not found');
        }

        $data = $this->getKegiatan($idKegiatan);
        if(!$data){
            return redirect()->back()->with('error', 'Kegiatan not found');
        }

        return view('admin.ukm-essensial.pengendalian-penyakit.category_p2.program.kegiatan.edit', ['program'=>$program, 'data'=>$data]);
    }

    public function update($id, $idProgram, Request $request){
        $program = $this->findProgram($id);
        if(!$program){
            return redirect()->back()->with('error', 'Program not found');
        }

        $data = $this->getKegiatan($idProgram);
        if(!$data){
            return redirect()->back()->with('error', 'Kegiatan not found');
        }
        
        $data->namaKegiatan = $request->namaKegiatan;
        $data->targetJumlah = $request->targetJumlah;
        $data->deskripsi = $request->deskripsi;

        try{
            $data->update();
            $tag = 'success';
            $message = 'Data updated successfully';
        } catch(Exception $e) {
            $tag = 'error';
            $message = $e->getMessage();
        }

        return redirect()->route('kegiatan-p2-index', ['id'=>$id])->with($tag, $message);

    }

    public function updateStatus($id, $idProgram, Request $request){
        $program = $this->findProgram($id);
        if(!$program){
            return redirect()->back()->with('error', 'Program not found');
        }

        $data = $this->getKegiatan($idProgram);
        if(!$data){
            return redirect()->back()->with('error', 'Kegiatan not found');
        }

        if($data->isActive){
            $data->isActive = false;
        } else{
            $data->isActive = true;
        }

        try{
            $data->update();
            $tag = 'success';
            $message = 'Data updated successfully';
        } catch(Exception $e) {
            $tag = 'error';
            $message = $e->getMessage();
        }

        return redirect()->route('kegiatan-p2-index', ['id'=>$id])->with($tag, $message);

    }



}
