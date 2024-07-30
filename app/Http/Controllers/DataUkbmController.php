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
        $dataUkbm = DB::table('data_ukbm')
            ->leftJoin('wilayah_kerja', 'data_ukbm.idDesa', '=', 'wilayah_kerja.id')
            ->leftJoin('jenis_ukbm', 'data_ukbm.idJenisUkbm', '=', 'jenis_ukbm.id')
            ->select('wilayah_kerja.namaDesa', 'jenis_ukbm.jenisUkbm', 'data_ukbm.*')
            ->get();

    return view('admin.ukm-essensial.promkes.promkes-umum.ukbm.index', compact('dataUkbm'));
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
        DataUkbm::create([
            'idDesa' => $request->namaDesa,
            'idJenisUkbm' => $request->jenisUkbm,
            'namaUkbm' => $request->namaUkbm,
            'alamatUkbm' => $request->alamatUkbm,
            'sumberPembiayaan' => $request->sumberPembiayaan,
            'kegiatanUkbm' => json_encode($request->kegiatan),
            'jumlahKader' => $request->jumlahKader,
            'jumlahKaderDilatih' => $request->jumlahKaderDilatih,
            'status' => 'active'
        ]);

        return redirect()->route('ukbm.data-ukbm.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $data = DataUkbm::findOrFail($id);
        if ($data->status == 'active') {
            $data->status = "inactive";
        } else {
            $data->status = "active";
        }
        $data->update();


        return redirect()->route('ukbm.data-ukbm.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = DB::table('data_ukbm')
            ->leftJoin('wilayah_kerja', 'data_ukbm.idDesa', '=', 'wilayah_kerja.id')
            ->leftJoin('jenis_ukbm', 'data_ukbm.idJenisUkbm', '=', 'jenis_ukbm.id')
            ->select(
                'wilayah_kerja.namaDesa',
                'jenis_ukbm.jenisUkbm',
                'data_ukbm.*'
            )
            ->where('data_ukbm.id', $id)
            ->get();
            

        #dd($data);
        return view('admin.ukm-essensial.promkes.promkes-umum.ukbm.data-ukbm.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = DataUkbm::findOrFail($id);
        $data->idDesa = $request->namaDesa;
        $data->idJenisUkbm = $request->jenisUkbm;
        $data->namaUkbm = $request->namaUkbm;
        $data->alamatUkbm = $request->alamatUkbm;
        $data->sumberPembiayaan = $request->sumberPembiayaan;
        $data->kegiatanUkbm = $request->kegiatanUkbm;
        $data->jumlahKader = $request->jumlahKader;
        $data->jumlahKaderDilatih = $request->jumlahKaderDilatih;
        $data->update();

        return redirect()->route('ukbm.data-ukbm.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       // nothing delete method here
    }
}
