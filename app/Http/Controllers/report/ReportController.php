<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use App\Models\AccessFeature;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(){
        $listAccessFeatures = AccessFeature::where('idUser', auth()->user()->id)
        ->join('divisi', 'access_features.idDivisi', '=', 'divisi.id')
        ->pluck('divisi.namaDivisi')
        ->toArray();

        return view('report.index', ['listAccessFeatures'=>$listAccessFeatures]);
    }
}
