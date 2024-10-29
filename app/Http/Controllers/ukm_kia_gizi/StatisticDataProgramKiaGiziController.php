<?php

namespace App\Http\Controllers\ukm_kia_gizi;

use App\helpers\MonthHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatisticDataProgramKiaGiziController extends Controller
{
    public function index(){
        $currentMonth = MonthHelper::logicGetMonth();
        $currentYear = MonthHelper::checkYear();

        return view('admin.ukm-essensial.kia-gizi.index_statistic', ['currentMonth'=>$currentMonth, 'currentYear'=>$currentYear]);
    }

    public function filterData(Request $request){
        $currentMonth = $request->month;
        $currentYear = $request->year;
        return view('admin.ukm-essensial.kia-gizi.index_statistic', ['currentMonth'=>$currentMonth, 'currentYear'=>$currentYear]);
    }
}
