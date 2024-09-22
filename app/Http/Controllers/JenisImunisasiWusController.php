<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\JenisImunisasiWus;

class JenisImunisasiWusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = JenisImunisasiWus::all();
        return view('admin.ukm-essensial.pengendalian-penyakit.imunisasi.imunisasi-wus.jenis-imunisasi.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ukm-essensial.pengendalian-penyakit.imunisasi.imunisasi-wus.jenis-imunisasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        JenisImunisasiWus::create([
            'namaImunisasi' => $request->jenis,
            'deskripsi' => $request->deskripsi,
            'isActive' => true
        ]);

        try{
            $tag = "success";
            $message = "Data berhasil disimpan!";
        }catch(Exception $e){
            $tag = "error";
            $message = $e->getMessage();
        }

        return redirect()->route('imunisasi-wus.jenis')->with($tag, $message);
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
        $data = JenisImunisasiWus::findOrFail($id);
        return view('admin.ukm-essensial.pengendalian-penyakit.imunisasi.imunisasi-wus.jenis-imunisasi.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = JenisImunisasiWus::find($id);
        $data->namaImunisasi = $request->jenis;
        $data->deskripsi = $request->deskripsi;

        try{
            $data->update();
            $tag = "success";
            $message = "Data berhasil diubah!";
        }catch(Exception $e){
            $tag = "error";
            $message = $e->getMessage();
        }

        return redirect()->route('imunisasi-wus.jenis')->with($tag, $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = JenisImunisasiWus::findOrFail($id);
        try{
            $data->delete();
            $tag = "success";
            $message = "Data berhasil dihapus!";
        }catch(Exception $e){
            $tag = "error";
            $message = $e->getMessage();
        }

        return redirect()->route('imunisasi-wus.jenis')->with($tag, $message);
    }

    public function updateStatus($id){
        $data = JenisImunisasiWus::find($id);

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
