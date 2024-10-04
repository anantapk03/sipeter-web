<?php

namespace App\View\Components;

use Closure;
use Exception;
use Carbon\Carbon;
use App\Models\JenisUkbm;
use App\Models\PencatatanUkbm;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class VisualisasiDataUkbm extends Component
{
    /**
     * Create a new component instance.
     */

    public $listJenisUkbm;
    public $listTargetUkbm;
    public $listCapaianUkbm;

    // Data UKBM
    public function getJenisUkbm(){
        try{
            $data = JenisUkbm::all();
            return $data;
        }catch(Exception $e){
            return $e;
        }
    }

    public function getYear(){
        $currentDay = date('j');   // Tanggal saat ini, misal: 1, 2, 3, ..., 31
        $currentYear = date('Y');   // Tanggal saat ini, misal: 1, 2, 3, ..., 31
        $year = $currentYear;
        $currentMonth = Carbon::now()->month;

        if($currentMonth==1){
            if($currentDay>5){
                $year = $currentYear ;
            } else{
                $year = $currentYear - 1;
            }
        }
        return $year;
    }

    public function getMonth(){
        $currentMonth = Carbon::now()->month;
        $currentDay = date('j');

        if($currentDay < 5){
            $currentMonth = $currentMonth - 1;
        }
        return $currentMonth;
    }

    public function getListCapaian(){
        $listIdJenis = $this->getJenisUkbm()->pluck('id')->toArray();
        $currentMonth = $this->getMonth();
        $currentYear = $this->getYear();
        $listCapaianUkbm = [];

        try{
            foreach($listIdJenis as $idJenis){
                $capaian = PencatatanUkbm::leftJoin('data_ukbm', function ($join) {
                    $join->on('pencatatan_data_ukbm.idDataUkbm', '=', 'data_ukbm.id');
                })->where('data_ukbm.idJenisUkbm', $idJenis)
                    ->where('bulan', $currentMonth)
                    ->where('tahun', $currentYear)
                    ->count('idJenisUkbm');
                $listCapaianUkbm[] = $capaian;
            }
            // dd($listCapaianUkbm);
            return $listCapaianUkbm;
        }catch(Exception $e){
            // dd($e);
            return [];
        }
        
    }
    
    public function __construct()
    {
        // Data Ukbm
        $this->listJenisUkbm = $this->getJenisUkbm()->pluck('jenisUkbm')->toArray();
        $this->listTargetUkbm = $this->getJenisUkbm()->pluck('bulanan')->toArray();
        $this->listCapaianUkbm = $this->getListCapaian();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.visualisasi-data-ukbm');
    }
}
