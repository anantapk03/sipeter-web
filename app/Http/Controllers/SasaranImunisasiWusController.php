<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\SasaranImunisasiWus;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SasaranImunisasiWusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DB::table('sasaran_imunisasi_wus')
            ->leftJoin('wilayah_kerja', 'sasaran_imunisasi_wus.idDesa', '=', 'wilayah_kerja.id')
            ->select('wilayah_kerja.namaDesa', 'sasaran_imunisasi_wus.*')
            ->get();

        //dd($data);
        return view('admin.ukm-essensial.pengendalian-penyakit.imunisasi.imunisasi-wus.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Desa::all();
        return view('admin.ukm-essensial.pengendalian-penyakit.imunisasi.imunisasi-wus.sasaran-imunisasi.create', compact('data'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        SasaranImunisasiWus::create([
            'idDesa' => $request->desa,
            'jumlahSasaran' => $request->jumlah
        ]);

        try{
            $tag = 'success';
            $message = 'Berhasil menyimpan data!';
        }catch(Exception $e){
            $tag = 'error';
            $message = $e->getMessage();
        }

        return redirect()->route('imunisasi-wus.sasaran')->with($tag, $message);
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
        $data = DB::table('sasaran_imunisasi_wus')
            ->where('sasaran_imunisasi_wus.id', $id)
            ->leftJoin('wilayah_kerja', 'sasaran_imunisasi_wus.idDesa', '=', 'wilayah_kerja.id')
            ->select('wilayah_kerja.namaDesa', 'sasaran_imunisasi_wus.*')
            ->get();
            
        #dd($data);
        return view('admin.ukm-essensial.pengendalian-penyakit.imunisasi.imunisasi-wus.sasaran-imunisasi.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = SasaranImunisasiWus::find($id);
        $data->jumlahSasaran = $request->jumlah;
        try{
            $data->update();
            $tag = 'success';
            $message = 'Berhasil mengubah data!';
        }catch(Exception $e){
            $tag = 'error';
            $message = $e->getMessage();
        }

        return redirect()->route('imunisasi-wus.sasaran')->with($tag, $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = SasaranImunisasiWus::find($id);
        try{
            $data->delete();
            $tag = 'success';
            $message = 'Berhasil menghapus data!';
        }catch(Exception $e){
            $tag = 'error';
            $message = $e->getMessage();
        }

        return redirect()->route('imunisasi-wus.sasaran')->with($tag, $message);
    }
}
