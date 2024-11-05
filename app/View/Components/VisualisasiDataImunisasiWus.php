<?php

namespace App\View\Components;

use Closure;
use Exception;
use Carbon\Carbon;
use Illuminate\View\Component;
use App\Models\LaporanImunisasiWus;
use App\Models\SasaranImunisasiWus;
use Illuminate\Contracts\View\View;

class VisualisasiDataImunisasiWus extends Component
{
    /**
     * Create a new component instance.
     */
    
    // inisialisasi variable yang diperlukan
    public $listSasaran;
    public $targetSasaran;
    public $listCapaian;
    public $monthNumber;
    public $year;


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


    // Mendapatkan data sasaran
    public function getListSasaran($monthNumber, $year){
        try{
            $data = SasaranImunisasiWus::where('bulan', $monthNumber)->where('tahun', $year)->leftJoin('wilayah_kerja', function ($join) {
                $join->on('sasaran_imunisasi_wus.idDesa', '=', 'wilayah_kerja.id');
            })->get();
            // dd($data);
            return $data;
        }catch(Exception $e){
            return 0;
        }
    }

    public function getSasaran($monthNumber, $year){
        try{
            $data = SasaranImunisasiWus::where('bulan', $monthNumber)->where('tahun', $year)->get();
            return $data;
        }catch(Exception $e){
            return $e;
        }
    }

    // mendapatkan jumlah pencatatan yang telah dilakukan (Capaian)
    public function getCapaianKegiatan(){
        
        $listIdSasaran = $this->getSasaran($this->monthNumber, $this->year)->pluck('id')->toArray();
       // dd($listIdSasaran);
        $listCapaianKegiatan = [];
        try{
            foreach($listIdSasaran as $idSasaran){
                $capaian = LaporanImunisasiWus::leftJoin('sasaran_imunisasi_wus', function ($join) {
                    $join->on('laporan_imunisasi_wus.idSasaran', '=', 'sasaran_imunisasi_wus.id');
                })->where('laporan_imunisasi_wus.idSasaran', $idSasaran)
                    ->count('idSasaran');
                $listCapaianKegiatan[] = $capaian;
            }
            // dd($listCapaianKegiatan);
            return $listCapaianKegiatan;
        }catch(Exception $e){
            return 0;
        }
    }
    public function __construct($monthNumber = null, $year = null)
    {
        $this->monthNumber = $monthNumber ?? $this->getMonth();
        $this->year = $year ?? $this->getYear();
        $this->listSasaran = $this->getListSasaran($this->monthNumber, $this->year)->pluck('namaDesa')->toArray();
        $this->targetSasaran = $this->getListSasaran($this->monthNumber, $this->year)->pluck('jumlahSasaran')->toArray();
        $this->listCapaian = $this->getCapaianKegiatan();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.visualisasi-data-imunisasi-wus');
    }
}
