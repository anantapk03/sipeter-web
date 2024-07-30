<?php

namespace App\Http\Controllers;

use App\Models\PeriodePencatatan;
use Illuminate\Http\Request;

class PeriodePencatatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = PeriodePencatatan::all();

        foreach($data as $datas){
            $datas->is_diabled = $datas->bulan < now();
        }
        return view('admin.ukm-essensial.promkes.promkes-umum.ukbm.pencatatan-ukbm.periode.report', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ukm-essensial.promkes.promkes-umum.ukbm.pencatatan-ukbm.periode.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        PeriodePencatatan::create([
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'is_disabled' => 0
        ]);

        return redirect()->route('ukbm.pencatatan-ukbm.report');
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
