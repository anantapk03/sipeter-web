<?php

namespace App\Http\Controllers\ukm_p2;

use App\Http\Controllers\Controller;
use App\Models\CategoryP2;
use Exception;
use Illuminate\Http\Request;

class CategoryP2Controller extends Controller
{
    public function index(){
        $data = CategoryP2::all();

        return view('admin.ukm-essensial.pengendalian-penyakit.category_p2.index', ['data' => $data]);
    }

    public function create(){
        return view('admin.ukm-essensial.pengendalian-penyakit.category_p2.create');
    }

    public function store(Request $request){
        $data = new CategoryP2();

        $data->namaCategory = $request->namaCategory;
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
        return redirect()->route('category-p2-index')->with($tag, $message);
    }

    public function edit($id){
        try{
            $data = CategoryP2::findOrFail($id);
        } catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }

        return view('admin.ukm-essensial.pengendalian-penyakit.category_p2.edit', ['data'=>$data]);

    }

    public function update($id, Request $request){
        try{
            $data = CategoryP2::findOrFail($id);
        } catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }

        $data->namaCategory = $request->namaCategory;
        $data->deskripsi = $request->deskripsi;

        try{
            $data->update();
            $tag = "success";
            $message = "Data berhasil ditambahkan";
        } catch(Exception $e){
            $tag = "error";
            $message = $e->getMessage();
        }

        return redirect()->route('category-p2-index')->with($tag, $message);   

    }

    public function updateStatus($id){
        try{
            $data = CategoryP2::findOrFail($id);
        } catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }

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

        return redirect()->route('category-p2-index')->with($tag, $message);

        
    }
}
