<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\KegiatanKesehatanKeliling;

class KegiatanKeslingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        $data = KegiatanKesehatanKeliling::all();
        return view('admin.ukm-essensial.kesehatan-lingkungan.index',  compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ukm-essensial.kesehatan-lingkungan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data_exist = KegiatanKesehatanKeliling::where('kegiatan', $request->kegiatan)->first();

        if($data_exist){
            $tag = "error";
            $message = "Data kegiatan tersebut sudah ada";
            return redirect()->route('kesling.kegiatan.index')->with($tag, $message);
        }

        KegiatanKesehatanKeliling::create([
            'kegiatan' => $request->kegiatan,
            'deskripsi' => $request->deskripsi,
            'bulanan' => $request->bulanan,
            'triwulan' => $request->triwulan,
            'semester' => $request->semester,
            'tahunan' => $request->tahunan,
            'status' => 'active'
        ]);

        try{
            $tag= "success";
            $message = "Data berhasil ditambahkan";
        } catch(Exception $e) {
            $tag = "error";
            $message = $e->getMessage();
        }

        return redirect()->route('kesling.kegiatan.index')->with($tag, $message);
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
        $data = KegiatanKesehatanKeliling::findOrFail($id);
        return view('admin.ukm-essensial.kesehatan-lingkungan.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = KegiatanKesehatanKeliling::findOrFail($id);
        $data->kegiatan = $request->kegiatan;
        $data->deskripsi = $request->deskripsi;
        $data->bulanan = $request->bulanan;
        $data->triwulan = $request->triwulan;
        $data->semester = $request->semester;
        $data->tahunan = $request->tahunan;
        try {
            $data->update();
            $tag = "success";
            $message = "Data berhasil diubah!";
        }catch(Exception $e){
            $tag = "error";
            $message = $e->getMessage();
        }

        return redirect()->route('kesling.kegiatan.index')->with($tag, $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = KegiatanKesehatanKeliling::findOrFail($id);
        try {
            $data->delete();
            $tag = "success";
            $message = "Data berhasil dihapus";
        }catch(Exception $e){
            $tag = "error";
            $message = $e->getMessage();
        }

        return redirect()->route('kesling.kegiatan.index')->with($tag, $message);
    }

    public function updateStatus($id)
    {
        // mengubah status kegiatan
        $data = KegiatanKesehatanKeliling::findOrFail($id);
        if ($data->status == 'active') {
            # Ubah status menjadi pasif
            $data->status = "inactive";
        } else {
            # Ubah status menjadi aktif kembali
            $data->status = "active";
        }

        try{
            $data->update();
            $tag = 'success';
            $message = 'Status berhasil diubah';
        }catch(Exception $e){
            $tag = 'error';
            $message = $e->getMessage();
        }

        return redirect()->route('kesling.kegiatan.index')->with($tag, $message);        
    }
}
