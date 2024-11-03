<?php

namespace App\Http\Controllers;

use App\helpers\MonthHelper;
use Illuminate\Http\Request;

class StatisticDataKeslingController extends Controller
{
    public function index(){
        $currentMonth = MonthHelper::logicGetMonth();
        $currentYear = MonthHelper::checkYear();

        return view('admin.ukm-essensial.kesehatan-lingkungan.index-statistic', compact('currentMonth', 'currentYear'));
    }

    public function filterData(Request $request){
        $currentMonth = $request->month;
        $currentYear = $request->year;
        
        return view('admin.ukm-essensial.kesehatan-lingkungan.index-statistic', compact('currentMonth', 'currentYear'));
    }
}
