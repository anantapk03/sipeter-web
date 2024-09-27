<?php

namespace App\View\Components;

use Closure;
use Exception;
use Carbon\Carbon;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use App\Models\KegiatanKesehatanKeliling;
use App\Models\PencatatanKegiatanKesling;

class VisualisasiDataKesling extends Component
{
    /**
     * Create a new component instance.
     */

    public $listKegiatan;
    public $listTargetKegiatan;
    public $listJumlahCapaian;
    public $year;

    // Fungsi mengambil nama kegiatan Kesehatan Lingkungan
    public function getListKegiatan(){
        try{
            $data = KegiatanKesehatanKeliling::all();
            return $data;
        }catch(Exception $e){
            dd($e);
            return 0;
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
        try{
            $data = PencatatanKegiatanKesling::all();
            return $data;
        }catch(Exception $e){
            dd($e);
            return 0;
        }
    }



    public function __construct()
    {
        $this->listKegiatan = $this->getListKegiatan()->pluck('kegiatan')->toArray();
        $this->listTargetKegiatan = $this->getListKegiatan()->pluck('bulanan')->toArray();
        $this->listJumlahCapaian = $this->getListCapaian()->pluck('jumlah')->toArray();

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.visualisasi-data-kesling');
    }
}
