<?php

namespace App\Http\Controllers\ukm_p2;

use App\Http\Controllers\Controller;
use App\Models\CategoryP2;
use App\Models\ProgramPengendalianPenyakit;
use Exception;
use Illuminate\Http\Request;

class ProgramP2Controller extends Controller
{
    
    public function findCategory($id){
        try{
            $data = CategoryP2::findOrFail($id);
            return $data;
        } catch(Exception $e){
            return null;
        }
    }

    public function index($id){
        $category = $this->findCategory($id);
        if(!$category){
            return redirect()->back()->with('error', 'category not found');
        }

        try{
            $data = ProgramPengendalianPenyakit::where('idCategory', $id)->orderBy('isActive', 'desc')->get();
        } catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage()); 
        }

        return view('admin.ukm-essensial.pengendalian-penyakit.category_p2.program.index', ['data' => $data, 'category'=>$category]);
    }

    public function create($id){
        $category = $this->findCategory($id);
        if(!$category){
            return redirect()->back()->with('error', 'category not found');
        }

        return view('admin.ukm-essensial.pengendalian-penyakit.category_p2.program.create', ['category'=>$category]);

    }

    public function store($id, Request $request){
        $category = $this->findCategory($id);
        if(!$category){
            return redirect()->back()->with('error', 'category not found');
        }

        $data = new ProgramPengendalianPenyakit();

        $data->idCategory = $id;
        $data->namaProgram = $request->namaProgram;
        $data->deskripsi = $request->deskripsi;
        $data->isActive = true;

        try{
            $data->save();
            $tag ='success';
            $message = 'data saved successfully';
        } catch(Exception $e) {
            $tag ='error';
            $message = 'data failed to save successfully';
        } 

        return redirect()->route('program-p2-index', ['id'=>$id])->with($tag,$message);
    }

    public function edit($id, $idProgram){
        $category = $this->findCategory($id);
        if(!$category){
            return redirect()->back()->with('error', 'category not found');
        }

        try{
            $data = ProgramPengendalianPenyakit::findOrFail($idProgram);
        } catch(Exception $e) {
            return redirect()->back()->with('error', 'data program not found');
        }

        return view('admin.ukm-essensial.pengendalian-penyakit.category_p2.program.edit', ['data' => $data, 'category' => $category]);


    }

    public function update($id, $idProgram, Request $request){
        $category = $this->findCategory($id);
        if(!$category){
            return redirect()->back()->with('error', 'category not found');
        }

        try{
            $data = ProgramPengendalianPenyakit::findOrFail($idProgram);
        } catch(Exception $e) {
            return redirect()->back()->with('error', 'data edit not found');
        }

        $data->namaProgram = $request->namaProgram;
        $data->deskripsi = $request->deskripsi;

        try{
            $data->update();
            $tag='success';
            $message ='Data has been updated successfully';
        } catch(Exception $e) {
            $tag = 'error';
            $message = 'Data failed to be updated';
        }

        return redirect()->route('program-p2-index', ['id'=>$id])->with($tag, $message);
    }

    public function updateStatus($id, $idProgram, Request $request){
        $category = $this->findCategory($id);
        if(!$category){
            return redirect()->back()->with('error', 'category not found');
        }

        try{
            $data = ProgramPengendalianPenyakit::findOrFail($idProgram);
        } catch(Exception $e) {
            return redirect()->back()->with('error', 'data edit not found');
        }

        if($data->isActive){
            $data->isActive = false;
        } else{
            $data->isActive = true;
        }

        try{
            $data->update();
            $tag='success';
            $message ='Data has been updated successfully';
        } catch(Exception $e) {
            $tag = 'error';
            $message = 'data failed to edit';
        }

        return redirect()->route('program-p2-index', ['id'=>$id])->with($tag, $message);

    }


}
