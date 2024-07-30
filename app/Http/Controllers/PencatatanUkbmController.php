<?php

namespace App\Http\Controllers;

use App\Models\DataUkbm;
use Illuminate\Http\Request;
use App\Models\PencatatanUkbm;
use App\Models\PeriodePencatatan;
use Illuminate\Support\Facades\DB;

class PencatatanUkbmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $periode = PeriodePencatatan::findOrFail($id);
        $dataPencatatan = DB::table('pencatatan_data_ukbm')
            ->leftJoin('data_ukbm', 'pencatatan_data_ukbm.idDataUkbm', '=', 'data_ukbm.id')
            ->leftJoin('periode_pencatatan', 'pencatatan_data_ukbm.idPeriode', '=', 'periode_pencatatan.id')
            ->select('data_ukbm.namaUkbm', 'pencatatan_data_ukbm.*')
            ->where('periode_pencatatan.id', '=', $id)
            ->get();

        #dd($dataPencatatan);
        return view('admin.ukm-essensial.promkes.promkes-umum.ukbm.pencatatan-ukbm.index', compact('dataPencatatan', 'periode'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $bulan = PeriodePencatatan::findOrFail($id);
        $data = DataUkbm::all();
        return view('admin.ukm-essensial.promkes.promkes-umum.ukbm.pencatatan-ukbm.create', compact('data', 'bulan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        PencatatanUkbm::create([
            'idDataUkbm' => $request->dataUkbm,
            'idPeriode' => $id,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('ukbm.pencatatan-ukbm.index', $id);
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
        $data = DB::table('pencatatan_data_ukbm')
            ->leftJoin('data_ukbm', 'pencatatan_data_ukbm.idDataUkbm', '=', 'data_ukbm.id')
            ->select('data_ukbm.namaUkbm', 'pencatatan_data_ukbm.*')
            ->where('pencatatan_data_ukbm.id', $id)
            ->get();
        return view('admin.ukm-essensial.promkes.promkes-umum.ukbm.pencatatan-ukbm.update', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = PencatatanUkbm::findOrFail($id);
        $data->deskripsi = $request->deskripsi;
        $data->update();

        return redirect()->route('ukbm.pencatatan-ukbm.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = PencatatanUkbm::findOrFail($id);
        $data->delete();

        return redirect()->route('ukbm.pencatatan-ukbm.index', $id);
    }
}
