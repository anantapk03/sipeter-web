<?php

namespace App\View\Components;

use App\helpers\MonthHelper;
use App\Models\Desa;
use App\Models\LaporanImunisasiBaduta;
use App\Models\SasaranImunisasiBaduta;
use Closure;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class VisualisasiImunisasiBaduta extends Component
{
    /**
     * Create a new component instance.
     */

     public $listDesaImunisasiBaduta;
     public $listTotalTypeImunisasiBadutaInReport;
     public $listTotalTargetJumlahImunisasiBadutaLakiDanPerempuan;
     public $listTotalCapaianJumlahImunisasiBadutaLakiDanPerempuan;
     public $year;
     public $monthNumber;
    public function __construct($month = null, $year = null)
    {
        $this->year = $year ?? MonthHelper::checkYear();
        $this->monthNumber = $month ?? MonthHelper::logicGetMonth();
        $this->listDesaImunisasiBaduta = $this->getListDesa()->pluck('namaDesa')->toArray();
        $this->listTotalTargetJumlahImunisasiBadutaLakiDanPerempuan = $this->getListTotalSasaranByIdDesa($this->monthNumber, $this->year);
        $this->listTotalCapaianJumlahImunisasiBadutaLakiDanPerempuan = $this->getListCapaianReportImunisasiBaduta($this->monthNumber, $this->year);
        $this->listTotalTypeImunisasiBadutaInReport = $this->getListTotalTypeImunisasiBadutaInReport($this->monthNumber, $this->year);
        
    }

    public function getListDesa(){
        try{
            $data = Desa::all();
            return $data;
        } catch(Exception $e){
            return collect();
        }
    }

    public function getSasaranReportByIdDesa($idDesa, $currentMonth, $currentYear){
        try{
            $data = SasaranImunisasiBaduta::where('idDesa',$idDesa)
            ->where('bulan', $currentMonth)
            ->where('tahun', $currentYear)
            ->first();
            return $data;
        } catch(Exception $e){
            return null;
        }
    }

    public function getIdListSasaranBaduta($currentMonth, $currentYear){
        $listIdDesa = $this->getListDesa()->pluck('id')->toArray();
        $listIdSasaranImunisasiBaduta = [];

        try{
            foreach($listIdDesa as $desaId){
                $dataDesaInReport = $this->getSasaranReportByIdDesa($desaId, $currentMonth, $currentYear);
                if($dataDesaInReport != null){
                    $listIdSasaranImunisasiBaduta[] = $dataDesaInReport->id;
                } else{
                    $listIdSasaranImunisasiBaduta[] = 0;
                }
            }

            return $listIdSasaranImunisasiBaduta;
        } catch(Exception $e){
            return [];
        }
    }

    public function getListTotalSasaranByIdDesa($currentMonth, $currentYear){
        $listIdDesa = $this->getListDesa()->pluck('id')->toArray();
        $listTotalSasaranByIdDesa = [];

        try{
            foreach($listIdDesa as $idDesa){
                $dataDesa = $this->getSasaranReportByIdDesa($idDesa, $currentMonth, $currentYear);
                if($dataDesa != null){
                    $sasaranLaki = $dataDesa->sasaran_laki;
                    $sasaranPerempuan = $dataDesa->sasaran_perempuan;
                    $total = $sasaranLaki+$sasaranPerempuan;
                    $listTotalSasaranByIdDesa[] = $total;
                } else{
                    $listTotalSasaranByIdDesa[] = 0;
                }
            }
            return $listTotalSasaranByIdDesa;
        } catch(Exception $e){
            return [];
        }
    }

    public function getReportByIdSasaran($idSasaran){
        try{
            $data = LaporanImunisasiBaduta::where('idSasaranImunisasi', $idSasaran)->get();
            return $data;
        } catch(Exception $e){
            return collect();
        }
    }

    public function getListCapaianReportImunisasiBaduta( $currentMonth, $currentYear){
        $listIdSasaran = $this->getIdListSasaranBaduta($currentMonth, $currentYear);
        $listCapaianByIdSasaran = [];

        try{
            foreach($listIdSasaran as $idSasaran){
                $dataReportByIdSasaran = $this->getReportByIdSasaran($idSasaran);
                if($dataReportByIdSasaran->isNotEmpty()){
                    $totalCapaianLaki = array_sum($dataReportByIdSasaran->pluck('jumlah_laki')->toArray());
                    $totalCapaianPerempuan = array_sum($dataReportByIdSasaran->pluck('jumlah_perempuan')->toArray());
                    $total = $totalCapaianLaki+$totalCapaianPerempuan;
                    $listCapaianByIdSasaran[] = $total; 
                } else{
                    $listCapaianByIdSasaran[] = 0;
                }
            }

            return $listCapaianByIdSasaran;
        } catch(Exception $e){
            return [];
        }
    }

    public function getListTotalTypeImunisasiBadutaInReport($currentMonth, $currentYear){
        $listIdSasaran = $this->getIdListSasaranBaduta($currentMonth, $currentYear);
        $listTotalTypeImunisasiBadutaInReport = [];

        try{
            foreach($listIdSasaran as $idSasaran){
                $dataReportByIdSasaran = $this->getReportByIdSasaran($idSasaran);
                if($dataReportByIdSasaran->isNotEmpty()){
                    $totalTypeImunisasi = count($dataReportByIdSasaran->pluck('idJenisImunisasi')->toArray());
                    $listTotalTypeImunisasiBadutaInReport[] = $totalTypeImunisasi;
                } else{
                    $listTotalTypeImunisasiBadutaInReport[] = 0;
                }
            }
            return $listTotalTypeImunisasiBadutaInReport;
        } catch(Exception $e){
            return [];
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.visualisasi-imunisasi-baduta');
    }
}
