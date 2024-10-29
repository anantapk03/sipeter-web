<?php

namespace App\View\Components;

use App\helpers\MonthHelper;
use App\Models\KegiatanProgramKiaGizi;
use App\Models\PencatatanKegiatanProgramKiaGizi;
use App\Models\ProgramKiaGizi;
use Closure;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class VisualisasiKiaGizi2 extends Component
{
    public $monthNumber;
    public $year;
    public $listProgram ;
    public $listTotalKegiatanInProgram ;
    public $listTotalKegiatanAchieveTarget;
    public $listTotalKegiatanInReportThisMonth;

    /**
     * Create a new component instance.
     */
    public function __construct($monthNumber = null, $year = null)
    {
        //
        $this->monthNumber = $monthNumber ?? MonthHelper::logicGetMonth();
        $this->year = $year ?? MonthHelper::checkYear();
        $this->listProgram = $this->getListProgram()->pluck('namaProgram')->toArray();
        $this->listTotalKegiatanInProgram = $this->getTotalKegiatanInProgram();
        $this->listTotalKegiatanInReportThisMonth = $this->getTotalKegiatanInReportThisMonth($this->monthNumber, $this->year);
        $this->listTotalKegiatanAchieveTarget = $this->getTotalKegiatanAchieveTarget($this->monthNumber, $this->year);
    }

    public function getListProgram(){
        try{
            $dataProgram = ProgramKiaGizi::where('isActive',true)->get();
            return $dataProgram;
        } catch(Exception $e){
            return collect();
        }
    }

    public function getKegiatansInProgram($idProgram){
        try{
            $data = KegiatanProgramKiaGizi::where('idProgramKiaGizi', $idProgram)->get()->pluck('id')->toArray();
            return $data;
        } catch(Exception $e){
            return [];
        }
    }

    public function getTotalKegiatanInProgram(){
        $dataProgram = $this->getListProgram()->pluck('id')->toArray();
        $dataTotalKegiatan = [];
        for($i =0;$i<count($dataProgram);$i++){
            $data = count($this->getKegiatansInProgram($dataProgram[$i]));
            array_push($dataTotalKegiatan, $data);
        }

        return $dataTotalKegiatan;
    }

    public function findKegiatanInReport($month, $year, $idKegiatan){
        try{
            $data = PencatatanKegiatanProgramKiaGizi::where('idKegiatanProgramKiaGizi', $idKegiatan)->where('bulan', $month)->where('tahun', $year)->get();
            return $data;
        } catch(Exception $e){
            return collect();
        }
    }

    public function getTotalKegiatanInReportThisMonth($month, $year){
        $idProgram = $this->getListProgram()->pluck('id')->toArray();
        $totalAkumulasiSetiapProgram = [];
    
        foreach ($idProgram as $programId) {
            $listIdKegiatanInProgram = $this->getKegiatansInProgram($programId);
            // dd($listIdKegiatanInProgram);
    
            // Inisialisasi ulang untuk setiap program
            $totalKegiatanInReportThisMonth = [];
    
            foreach ($listIdKegiatanInProgram as $kegiatanId) {
                // Mengambil kegiatan dalam report
                $getKegiatanInReport = $this->findKegiatanInReport($month, $year, $kegiatanId)->toArray();
                // dd($getKegiatanInReport);
                
                // Hitung total kegiatan dalam report
                $totalKegiatanInReport = count($getKegiatanInReport);
                if($totalKegiatanInReport > 0){
                    $kegiatanDilaksanakan = 1;
                } else{
                    $kegiatanDilaksanakan = 0;
                }
    
                // Tambahkan ke array
                $totalKegiatanInReportThisMonth[] = $kegiatanDilaksanakan;
            }

            // dd($totalKegiatanInReportThisMonth);
    
            // Akumulasi total kegiatan per program
            $totalAkumulasiSetiapProgram[] = array_sum($totalKegiatanInReportThisMonth);
        }

        // dd($totalAkumulasiSetiapProgram);

    
        return $totalAkumulasiSetiapProgram;
    }
    

    public function getTotalKegiatanAchieveTarget($month, $year){
        $idProgram = $this->getListProgram()->pluck('id')->toArray();
        $totalAkumulasiSetiapProgram = [];

        foreach($idProgram as $programId){
            $listIdKegiatanInProgram = $this->getKegiatansInProgram($programId);

            // Inisialisasi ulang untuk setiap program
            $totalKegiatanInReportThisMonth = [];

            // Target Jumlah Akumulasi Capaian Bulanan setiap program
            $targetJumlah = KegiatanProgramKiaGizi::where('id', $programId)->pluck('targetBulanan')->first();
            // dd($targetJumlah);

            foreach($listIdKegiatanInProgram as $kegiatanId){
                // Mengambil kegiatan dalam report
                $getKegiatanInReport = $this->findKegiatanInReport($month, $year, $kegiatanId);

                $jumlahCapaian = array_sum($getKegiatanInReport->pluck('jumlah')->toArray());
                // dd($jumlahCapaian);
                if($jumlahCapaian > $targetJumlah){
                    array_push($totalKegiatanInReportThisMonth, 1);
                } else{
                    array_push($totalKegiatanInReportThisMonth, 0);
                }
            }

            $totalAkumulasiSetiapProgram[] = array_sum($totalKegiatanInReportThisMonth);

        }

        return $totalAkumulasiSetiapProgram;

    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.visualisasi-kia-gizi2');
    }
}
