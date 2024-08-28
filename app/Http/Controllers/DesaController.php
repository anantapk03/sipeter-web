<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Desa;
use Illuminate\Http\Request;

class DesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Desa::all();
        return view('admin.desa-management.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.desa-management.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Desa::create([
            'namaDesa' => $request->desa,
            'lat' => $request->lat,
            'lon' => $request->lng
        ]);
        try{
            $tag= "success";
            $message = "Data berhasil ditambahkan";
        } catch(Exception $e) {
            $tag = "error";
            $message = $e->getMessage();
        }

        return redirect()->route('desa.index')->with($tag, $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Desa::findOrFail($id);
        return view('admin.desa-management.update', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Desa::findOrFail($id);
        $data->namaDesa = $request->desa;
        $data->lat = $request->lat;
        $data->lon = $request->lng;
        try{
            $data->update();
            $tag= "success";
            $message = "Data berhasil diperbarui";
        } catch(Exception $e) {
            $tag = "error";
            $message = $e->getMessage();
        }

        return redirect()->route('desa.index')->with($tag, $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Desa::findOrFail($id);
        try{
            $data->delete();
            $tag= "success";
            $message = "Data berhasil dihapus";
        } catch(Exception $e) {
            $tag = "error";
            $message = $e->getMessage();
        }

        return redirect()->route('desa.index');
    }
}
