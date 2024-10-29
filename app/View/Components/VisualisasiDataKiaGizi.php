<?php

namespace App\View\Components;

use App\Models\KegiatanProgramKesehatanSekolah;
use App\Models\PencatatanKegiatanProgramKesehatanSekolah;
use Carbon\Carbon;
use Closure;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class VisualisasiDataKiaGizi extends Component
{
    /**
     * Create a new component instance.
     */

     public $listKegiatan ;
     public $listTotalKelasKegiatan;
     public $listTotalCapaian;
     public $listTotalTarget;
     public $monthNumber;
     public $year;
    public function __construct($monthNumber = null, $year = null)
    {
        $this->listKegiatan = $this->getKegiatanUKS()->pluck('namaKegiatan')->toArray();
        $this->listTotalTarget = $this->getKegiatanUKS()->pluck('targetBulanan')->toArray();
        $this->monthNumber = $monthNumber ?? $this->getMonth();
        $this->year = $year ?? $this->getYear();
        $this->listTotalCapaian = $this->getListTotalCapaian($this->year, $this->monthNumber);
        $this->listTotalKelasKegiatan = $this->getTotalLocation($this->year, $this->monthNumber);

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

    public function getKegiatanUKS(){
        try{
            $data = KegiatanProgramKesehatanSekolah::where('isActive', true)->get();
            return $data;
        }
        catch(Exception $e){
            return collect();
        }
    }

    public function getListTotalCapaian($currentYear, $currentMonth){
        $listIdKegiatan = $this->getKegiatanUKS()->pluck('id');
        $listTotalCapaianKegiatan = [];

        for($i=0;$i<count($listIdKegiatan);$i++){
            try{
                $data = PencatatanKegiatanProgramKesehatanSekolah::where('idKegiatanProgramKesehatanSekolah', $listIdKegiatan[$i])
                ->where('bulan', $currentMonth)
                ->where('tahun', $currentYear)
                ->get()
                ->pluck('jumlah')
                ->toArray();

                $total = array_sum($data);

                array_push($listTotalCapaianKegiatan, $total);
            } catch(Exception $e){
                array_push($listTotalCapaianKegiatan, 0);
            }
        }

        return $listTotalCapaianKegiatan;
    }

    public function getTotalLocation($currentYear, $currentMonth){
        $listIdKegiatan = $this->getKegiatanUKS()->pluck('id');
        $listLocation = [];

        for($i=0;$i<count($listIdKegiatan);$i++){
            try{
                $data = PencatatanKegiatanProgramKesehatanSekolah::where('idKegiatanProgramKesehatanSekolah', $listIdKegiatan[$i])
                ->where('bulan', $currentMonth)
                ->where('tahun', $currentYear)
                ->get()
                ->pluck('idKelasSiswa')
                ->toArray();

                $totalKelas = count($data);

                array_push($listLocation, $totalKelas);
            } catch(Exception $e){
                array_push($listLocation, 0);
            }

            return $listLocation;
        }

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.visualisasi-data-kia-gizi');
    }
}
