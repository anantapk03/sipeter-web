<?php

namespace App\View\Components;

use App\helpers\MonthHelper;
use App\Models\CategoryP2;
use App\Models\KegiatanProgramPengendalianPenyakit;
use App\Models\PencatatanProgramPengendalianPenyakit;
use App\Models\ProgramPengendalianPenyakit;
use Closure;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class VisualisasiDataPengendalianPenyakitTidakMenular extends Component
{

    public $getCategoryTidakMenular;
    public $listNamaProgramP2TidakMenular;
    public $listTotalKegiatanForEachProgramTidakMenular;
    public $listTotalCapaianKegiatanTidakMenular;
    public $listTotalKegiatanBelumMencapaiTargetTidakMenular;
    public $monthNumber;
    public $year;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->monthNumber = MonthHelper::logicGetMonth();
        $this->year = MonthHelper::checkYear();
        $this->getCategoryTidakMenular = $this->getCategory();
        $this->listNamaProgramP2TidakMenular = $this->getListProgramNameP2Menular();
        $this->listTotalKegiatanForEachProgramTidakMenular = $this->getListTotalKegiatanForeachProgram();
        $this->listTotalCapaianKegiatanTidakMenular = $this->getListTotalKegiatanYangDilaksanakan();
        $this->listTotalKegiatanBelumMencapaiTargetTidakMenular = $this->getListTotalKegiatanBelumMencapaiTarget();
    }

    public function getCategory(){
        try{
            $data = CategoryP2::where('namaCategory', "Tidak Menular")->where('isActive', true)->first()->id;
            return $data;
        } catch(Exception $e){
            return null;
        }
    }

    public function getListProgramP2Menular($idCategory){
        try{
            $data = ProgramPengendalianPenyakit::where('idCategory', $idCategory)->where('isActive', true)->get();
            return $data;
        } catch(Exception $e){
            return collect();
        }
    }

    public function getListProgramNameP2Menular(){
        $idCategory = $this->getCategory();
        if($idCategory != null){
            $dataListProgram = $this->getListProgramP2Menular($idCategory)->pluck('namaProgram')->toArray();
            return $dataListProgram;
        } else{
            return [];
        }
    }

    public function getKegiatanProgramById($idProgram){
        try{
            $data = KegiatanProgramPengendalianPenyakit::where('idProgram',$idProgram)->get();
            return $data;
        } catch(Exception $e){
            return collect();
        }
    }

    public function getListTotalKegiatanForeachProgram(){
        $idCategory = $this->getCategory();
        $dataListTotalKegiatanForeachProgram = [];
        if($idCategory != null){
            $listIdProgram = $this->getListProgramP2Menular($idCategory)->pluck('id')->toArray();

            foreach($listIdProgram as $idProgram){
                $dataKegiatanByProgram = $this->getKegiatanProgramById($idProgram)->pluck('id')->toArray();
                $totalKegiatan = count($dataKegiatanByProgram);
                $dataListTotalKegiatanForeachProgram[] = $totalKegiatan;
            }

            return $dataListTotalKegiatanForeachProgram;
        } else{
            return [];
        }
    }

    public function getReportByIdKegiatan($idKegiatan){
        $currentMonth = MonthHelper::logicGetMonth();
        $currentYear = MonthHelper::checkYear();

        try{
            $data = PencatatanProgramPengendalianPenyakit::where('idKegiatan', $idKegiatan)->where('bulan', $currentMonth)->where('tahun', $currentYear)->first();
            return $data;
        } catch(Exception $e){
            return null;
        }
    }

    public function getListTotalKegiatanYangDilaksanakan(){
        $idCategory = $this->getCategory();
        $dataListTotalKegiatanForeachProgramDo = [];
        
        if($idCategory != null){
            $listIdProgram = $this->getListProgramP2Menular($idCategory)->pluck('id')->toArray();
            foreach($listIdProgram as $idProgram){
                $dataKegiatanByProgram = $this->getKegiatanProgramById($idProgram)->pluck('id')->toArray();
                $dataTotalCapaian = [];
                foreach($dataKegiatanByProgram as $idKegiatan){
                    $data = $this->getReportByIdKegiatan($idKegiatan);
                    if($data != null){
                        $dataTotalCapaian[] = 1;
                    } else{
                        $dataTotalCapaian[] = 0;
                    }
                }
                $dataListTotalKegiatanForeachProgramDo[] = array_sum($dataTotalCapaian);
            }

            return $dataListTotalKegiatanForeachProgramDo;
            
        } else{
            return [];
        }
    }

    public function getListTotalKegiatanBelumMencapaiTarget(){
        $idCategory = $this->getCategory();
        $listTotalKegiatanBelumMencapaiTarget = [];
        
        if($idCategory != null){
            $listIdProgram = $this->getListProgramP2Menular($idCategory)->pluck('id')->toArray();
            foreach($listIdProgram as $idProgram){
                $dataKegiatanByProgram = $this->getKegiatanProgramById($idProgram)->pluck('id')->toArray();
                $dataJumlahSasaranKegiatan = $this->getKegiatanProgramById($idProgram)->pluck('targetJumlah')->toArray();
                $dataTotalKegiatanBelumMencapaiTarget = [];
                foreach($dataKegiatanByProgram as $key => $idKegiatan){
                    $dataKegiatanInReport = $this->getReportByIdKegiatan($idKegiatan);
                    $targetJumlah = $dataJumlahSasaranKegiatan[$key];
                    if($dataKegiatanInReport != null){
                        if($targetJumlah>$dataKegiatanInReport->jumlah){
                            $dataTotalKegiatanBelumMencapaiTarget[] = 1;
                        } else{
                            $dataTotalKegiatanBelumMencapaiTarget[] = 0;
                        }
                    } else{ 
                        $dataTotalKegiatanBelumMencapaiTarget[] = 0;
                    }
                }
                $listTotalKegiatanBelumMencapaiTarget[] = array_sum($dataTotalKegiatanBelumMencapaiTarget);
            }

            return $listTotalKegiatanBelumMencapaiTarget;
            
        } else{
            return [];
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.visualisasi-data-pengendalian-penyakit-tidak-menular');
    }
}
