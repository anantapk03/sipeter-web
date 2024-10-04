<?php

namespace App\View\Components;

use App\helpers\MonthHelper;
use App\Models\KegiatanProgramPromkes;
use App\Models\PencatatanKegiatanProgramPromkes;
use App\Models\ProgramDivisiPromkes;
use Closure;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class VisualisasiDataPromkesLain extends Component
{
    /**
     * Create a new component instance.
     */

    public $listProgramPromkes;
    public $kegiatanInProgram;
    public $totalKegiatan;
    public $jumlahKegiatanInReport;
    public $jumlahKegiatanMemenuhiTarget;
    public $monthNumber;
    public $year;


    // mendapatkan nama program kesehatan yang ada
    public function listPromkes(){
        try{
            $data = ProgramDivisiPromkes::where('isActive', true)->get();
            return $data;
        }catch(Exception $e){
            return 0;
        }
    }

    // mendapatkan id kegiatan perprogram
    public function getKegiatan($idProgram){
        try{
            $data = KegiatanProgramPromkes::where('idProgram', $idProgram)->get()->pluck('id')->toArray();
            return $data;
        }catch(Exception $e){
            return $e;
        }
    }

    public function findKegiatanInReport($month, $year, $idKegiatan){
        try{
            $data = PencatatanKegiatanProgramPromkes::where('idKegiatanProgramPromkes', $idKegiatan)
                ->where('bulan', $month)
                ->where('tahun', $year)
                ->get();
            return $data;
        }catch(Exception $e){
            return collect();
        }
    }

    // mendapatkan jumlah kegiatan perprogram
    public function getTotalKegiatan(){
        $dataProgram = $this->listPromkes()->pluck('id')->toArray();
        $dataTotalKegiatan = [];
        for($i = 0; $i < count($dataProgram); $i++){
            $data = count($this->getKegiatan($dataProgram[$i]));
            array_push($dataTotalKegiatan, $data);
        }

        return $dataTotalKegiatan;
    }

    // mendapatkan jumlah kegiatan perprogram dalam bulan khusus
    public function getKegiatanInReportThisMonth($month, $year)
    {
        $idProgram = $this->listPromkes()->pluck('id')->toArray();
        $akumulasiProgram = [];

        foreach ($idProgram as $program) {
            $listKegiatan = $this->getKegiatan($program);

            // Inisialisasi ulang untuk setiap program
            $totalKegiatanInReportThisMonth = [];

            foreach ($listKegiatan as $kegiatan) {
                // mengambil kegiatan dalam report
                $getkegiatanInReport = $this->findKegiatanInReport($month, $year, $kegiatan)->toArray();

                // hitung jumlah kegiatan
                $jumlahKegiatanInReport = count($getkegiatanInReport);
                if ($jumlahKegiatanInReport > 0) {
                    $kegiatanDilaksanakan = 1;
                } else {
                    $kegiatanDilaksanakan = 0;
                }

                // Masukan kedalam array
                $totalKegiatanInReportThisMonth[] = $kegiatanDilaksanakan;
            }
            $akumulasiProgram[] = array_sum($totalKegiatanInReportThisMonth);
        }
        return $akumulasiProgram;
    }

    // Mendapatkan nilai kegiatan yang sudah mencapai target
    public function getKegiatanAchieveTarget($month, $year){
        $idProgram = $this->listPromkes()->pluck('id')->toArray();
        $akumulasiNilaiTiapProgram = [];

        foreach($idProgram as $program){
            $listIdKegiatanProgram = $this->getKegiatan($program);

            // Inisiasi ulang untuk tiap program
            $totalKegiatanInThisReport = [];

            // Mendapat kegiatan dengan target bulan
            $targetJumlah = KegiatanProgramPromkes::where('id', $program)->pluck('targetBulanan')->first();

            foreach($listIdKegiatanProgram as $kegiatan){
                // mengambil kegiatan dalam report
                $getKegiatanInReport = $this->findKegiatanInReport($month, $year, $kegiatan);
                $jumlahCapaian = array_sum($getKegiatanInReport->pluck('jumlah')->toArray());
                if($jumlahCapaian > $targetJumlah){
                    array_push($totalKegiatanInThisReport, 1);
                }else{
                    array_push($totalKegiatanInThisReport, 0);
                }
            }

            $akumulasiNilaiTiapProgram[] = array_sum($totalKegiatanInThisReport);
        }
        return $akumulasiNilaiTiapProgram;
    }
    

    public function __construct()
    {
        $this->listProgramPromkes = $this->listPromkes()->pluck('namaProgram')->toArray();
        $this->totalKegiatan = $this->getTotalKegiatan();
        $this->jumlahKegiatanInReport = $this->getKegiatanInReportThisMonth(MonthHelper::logicGetMonth(), MonthHelper::checkYear());
        $this->jumlahKegiatanMemenuhiTarget = $this->getKegiatanAchieveTarget(MonthHelper::logicGetMonth(), MonthHelper::checkYear());
        $this->monthNumber = MonthHelper::logicGetMonth();
        $this->year = MonthHelper::checkYear();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.visualisasi-data-promkes-lain');
    }
}
