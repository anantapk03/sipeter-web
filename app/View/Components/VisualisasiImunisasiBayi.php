<?php

namespace App\View\Components;

use App\helpers\MonthHelper;
use App\Models\Desa;
use App\Models\JenisImunisasiBayi;
use App\Models\LaporanImunisasiBayi;
use App\Models\SasaranImunisasiBayi;
use Closure;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class VisualisasiImunisasiBayi extends Component
{
    public $monthNumber ;
    public $year; 
    public $listJenisImunisasi;

    public $listDesa;
    public $totalImunisasiBySasaranId;
    public $totalSasaranSurvifingInfantAndBayi ;
    public $totalCapaianImunisasiPerDesa;
    /**
     * Create a new component instance.
     */
    public function __construct($month = null, $year = null)
    {
        $this->year = $year ?? MonthHelper::checkYear();
        $this->monthNumber =  $month ?? MonthHelper::logicGetMonth();
        $this->listDesa = $this->getListDesa()->pluck('namaDesa')->toArray();
        $this->totalImunisasiBySasaranId = $this->getListTotalImunisasiInReport($this->monthNumber, $this->year);
        $this->totalSasaranSurvifingInfantAndBayi = $this->getListSasaranSurvifingInfantAndBayi($this->monthNumber, $this->year);
        $this->totalCapaianImunisasiPerDesa = $this->getListCapaianImunisasi($this->monthNumber, $this->year);

    }

    public function getListDesa(){
        try{
            $data = Desa::all();
            return $data;
        } catch(Exception $e){
            return collect();
        }
    }

    public function getSasaranReport($idDesa, $currentMonth, $currentYear){
        try{
            $data = SasaranImunisasiBayi::where('idDesa', $idDesa)->where('bulan', $currentMonth)->where('tahun', $currentYear)->first();
            return $data;
        } catch(Exception $e){
            return null;
        }
    }

    public function sasaranDesaInReport($currentMonth, $currentYear){
        $idDesa = $this->getListDesa()->pluck('id')->toArray();
        $listIdSasaranReport = [];
        try{
            foreach($idDesa as $desaId){
                $dataDesaInReport = $this->getSasaranReport($desaId, $currentMonth, $currentYear);
                if($dataDesaInReport != null){
                    $listIdSasaranReport[] = $dataDesaInReport->id;
                } else{
                    $listIdSasaranReport[] = 0;
                }
            }

            return $listIdSasaranReport;
            
        } catch(Exception $e){
            return [];
        }
    }

    public function getReportByIdSasaran($idSasaran){
        try{
            $data = LaporanImunisasiBayi::where('idSasaran', $idSasaran)->get();
            return $data;
        } catch(Exception $e){
            return collect();
        }
    }

    public function getListTotalImunisasiInReport($currentMonth, $currentYear){
        $dataReport = $this->sasaranDesaInReport($currentMonth, $currentYear);
        // dd($dataReport);
        $listTotalImunisasiInReport = [];
        try{
            foreach($dataReport as $sasaranId){

                if($sasaranId != 0){
                    $getReportByIdSasaran = $this->getReportByIdSasaran($sasaranId)->pluck('idJenisImunisasi')->toArray();
                    // dd($getReportByIdSasaran);
                    $totalImunisasiInDesa = count($getReportByIdSasaran);
                } else{
                    $totalImunisasiInDesa = 0;
                }
                $listTotalImunisasiInReport[] = $totalImunisasiInDesa;
            }
            // dd($listTotalImunisasiInReport);

            return $listTotalImunisasiInReport;
        } catch(Exception $e){
            // echo'<div class="alert alert-danger">Error data:'.$e->getMessage().'</div>';
            return [];
        }
    }

    public function getListSasaranSurvifingInfantAndBayi($currentMonth, $currentYear){
        $idDesa = $this->getListDesa()->pluck('id')->toArray();
        $listTotalSasaranSurvifingInfantAndBayi = [];

        try{
            foreach($idDesa as $desaId){
                $dataDesaInReport = $this->getSasaranReport($desaId, $currentMonth, $currentYear);
                if($dataDesaInReport != null){
                    $survifingInfantLaki = $dataDesaInReport->jumlah_surviving_infant_laki;
                    $survifingInfantPerempuan = $dataDesaInReport->jumlah_surviving_infant_perempuan;
                    $sasaranBayiLaki = $dataDesaInReport->jumlah_sasaran_bayi_laki;
                    $sasaranBayiPerempuan = $dataDesaInReport->jumlah_sasaran_bayi_perempuan;

                    $total = $survifingInfantLaki+$survifingInfantPerempuan+$sasaranBayiLaki+$sasaranBayiPerempuan;

                    $listTotalSasaranSurvifingInfantAndBayi[] = $total;
                } else{
                    $listTotalSasaranSurvifingInfantAndBayi[] = 0;
                }
            }

            // dd($listTotalSasaranSurvifingInfantAndBayi);

            return $listTotalSasaranSurvifingInfantAndBayi;
        } catch(Exception $e){
            return [];
        }

    }

    public function getListCapaianImunisasi($currentMonth, $currentYear){
        $dataReport = $this->sasaranDesaInReport($currentMonth, $currentYear);
        // dd($dataReport);
        $listTotalCapaianImunisasiPerDesa = [];

        try{
            foreach($dataReport as $sasaranId){
                if($sasaranId != 0){
                    $getReportByIdSasaranLaki = array_sum($this->getReportByIdSasaran($sasaranId)->pluck('jumlah_laki')->toArray());
                    $getReportByIdSasaranPerempuan = array_sum($this->getReportByIdSasaran($sasaranId)->pluck('jumlah_perempuan')->toArray());
                    $total = $getReportByIdSasaranLaki + $getReportByIdSasaranPerempuan;

                    $listTotalCapaianImunisasiPerDesa[] = $total;
                } else{
                    $listTotalCapaianImunisasiPerDesa[] = 0;
                }
            }

            return $listTotalCapaianImunisasiPerDesa;
        } catch(Exception $e){
            return [];
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.visualisasi-imunisasi-bayi');
    }
}
