<?php

namespace App\Http\Controllers\ukm_promkes;

use App\Http\Controllers\Controller;
use App\Models\SubKegiatanPromosiKesehatanDesa;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class KegiatanPromosiKesehatanUmumDesaController extends Controller
{
    public function index(){
        $data = SubKegiatanPromosiKesehatanDesa::where('isActive', true)->get();
        return view('admin.ukm-essensial.promkes.promkes-umum.promkes-desa.index', ['data' => $data]);
    }

    public function create(){
        return view('admin.ukm-essensial.promkes.promkes-umum.promkes-desa.create');
    }

    public function store(Request $request){
        $dataForm = new SubKegiatanPromosiKesehatanDesa();
        $dataForm->namaKegiatan = $request->namaKegiatan ;
        $dataForm->deskripsiKegiatan = $request->deskripsiKegiatan;
        $dataForm->targetBulanan = $request->targetBulanan;
        $dataForm->targetTriwulan = $request->targetTriwulan;
        $dataForm->targetSemester = $request->targetSemester;
        $dataForm->targetTahunan = $request->targetTahunan;
        $dataForm->isActive = true;
        try{
            $dataForm->save();
            return redirect(route('program-kegiatan-promkes-desa-index'))->with('success', 'Data berhasil ditambahkan');
        } catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id){
        $data = SubKegiatanPromosiKesehatanDesa::find($id);
        return view('admin.ukm-essensial.promkes.promkes-umum.promkes-desa.update', ['data' => $data]);
    }

    public function update($id, Request $request){
        $dataForm = SubKegiatanPromosiKesehatanDesa::find($id);
        $dataForm->namaKegiatan = $request->namaKegiatan ;
        $dataForm->deskripsiKegiatan = $request->deskripsiKegiatan;
        $dataForm->targetTriwulan = $request->targetTriwulan;
        $dataForm->targetSemester = $request->targetSemester;
        $dataForm->targetTahunan = $request->targetTahunan;
        $dataForm->isActive = $request->isActive;
        try{
            $dataForm->update();
            return redirect(route('program-kegiatan-promkes-desa-index'))->with('success', 'Data berhasil diperbarui');
        } catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function info($id){
        $year = Carbon::now()->format('Y');
        $data = SubKegiatanPromosiKesehatanDesa::find($id);
        return view('admin.ukm-essensial.promkes.promkes-umum.promkes-desa.report-promkes-desa.index', ['data' => $data, 'year'=>$year]);
    }

    public function updateStatus($id, Request $request){
        $dataForm = SubKegiatanPromosiKesehatanDesa::find($id);
        if($dataForm->isActive){
            $dataForm->isActive = false;
        } else{
            $dataForm->isActive = true;
        }
        try{
            $dataForm->update();
            return redirect(route('program-kegiatan-promkes-desa-index'))->with('success', 'Status kegiatan berhasil diubah');
        } catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }



}
