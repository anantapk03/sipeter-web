<?php

namespace App\Http\Controllers\ukm_promkes;

use App\Http\Controllers\Controller;
use App\Models\SubKegiatanPromosiKesehatanDesa;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PencatatanKegiatanPromosiKesehatanUmumDesa extends Controller
{
    public function index($id){
        $year = Carbon::now()->format('Y');
        $data = SubKegiatanPromosiKesehatanDesa::find($id);
        return view('admin.ukm-essensial.promkes.promkes-umum.promkes-desa.report-promkes-desa.index', ['data' => $data, 'year'=>$year]);
    }
}
