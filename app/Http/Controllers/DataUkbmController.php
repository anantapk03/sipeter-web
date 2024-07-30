<?php

namespace App\Http\Controllers;

use App\Models\DataUkbm;
use App\Models\Desa;
use App\Models\JenisUkbm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataUkbmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        //
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dataDesa = Desa::all();
        $dataJenisUkbm = JenisUkbm::all();
        return view('admin.ukm-essensial.promkes.promkes-umum.ukbm.data-ukbm.create', compact('dataDesa', 'dataJenisUkbm'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = DataUkbm::create([
            'idDesa' => $request->namaDesa,
            'idJenisUkbm' => $request->jenisUkbm,
            'namaUkbm' => $request->namaUkbm,
            'alamatUkbm' => $request->alamatUkbm,
            'sumberPembiayaan' => $request->sumberPembiayaan,
            'kegiatanUkbm' => json_encode($request->kegiatan),
            'jumlahKader' => $request->jumlahKader,
            'jumlahKaderDilatih' => $request->jumlahKaderDilatih
        ]);

        return redirect()->route('ukbm.index');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
