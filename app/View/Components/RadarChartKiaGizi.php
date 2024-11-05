<?php

namespace App\View\Components;

use App\Helpers\AppConst;
use App\helpers\MonthHelper;
use App\Models\Desa;
use App\Models\KegiatanProgramKiaGizi;
use App\Models\PencatatanKegiatanProgramKiaGizi;
use App\Models\ProgramKiaGizi;
use Closure;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RadarChartKiaGizi extends Component
{
    /**
     * Create a new component instance.
     */

    public $currentMonth;
    public $currentYear;
    public $labelProgramKiaGiziRadarChart;
    public $labelDatasetsKiaGiziRadarChart;
    
    public function __construct($month = null, $year = null)
    {
        $this->currentMonth = $month ?? MonthHelper::logicGetMonth();
        $this->currentYear = $year ?? MonthHelper::checkYear();
        $this->labelProgramKiaGiziRadarChart = json_encode($this->getListLablesProgram()->pluck('namaProgram')->toArray());
        $this->labelDatasetsKiaGiziRadarChart = json_encode($this->getDataset($this->currentMonth, $this->currentYear));
    }

    public function getListLablesProgram(){
        try{
            $data = ProgramKiaGizi::where('isActive', true)->get();
            return $data;
        } catch(Exception $e){
            return collect();
        }
    }

    public function getAllDesa(){
        try{
            $data = Desa::all();
            return $data;
        } catch(Exception $e){
            return collect();
        }
    }

    public function getListIdKegiatanByIdProgram($idProgram){
        try{
            $dataKegiatan = KegiatanProgramKiaGizi::where('idProgramKiaGizi', $idProgram)->get()->pluck('id')->toArray();
            return $dataKegiatan;
        } catch(Exception $e){
            return [];
        }
    }

    public function findKegiatanHasReportbyIdProgramandDesa($idDesa, $idKegiatan, $currentMonth, $currentYear){
        try{
            $data = PencatatanKegiatanProgramKiaGizi::where('idKegiatanProgramKiaGizi', $idKegiatan)
            ->where('idDesa', $idDesa)->where('bulan', $currentMonth)->where('tahun', $currentYear)
            ->get()->pluck('id')->toArray();

            if(count($data) > 0){
                return 1;
            } else{
                return 0;
            }
        } catch(Exception $e){
            return 0;
        }
    }

    // Setiap Satu Program memiliki beberapa kegiatan
    public function getTotalKegiatanDoneReportByIdDesaAndKegiatan($idDesa, $listIdKegiatan, $currentMonth, $currentYear){
        $totalKegiatanHasReport = 0;
        foreach($listIdKegiatan as $idKegiatan){
            $isHasReport = $this->findKegiatanHasReportbyIdProgramandDesa($idDesa, $idKegiatan, $currentMonth, $currentYear);
            $totalKegiatanHasReport += $isHasReport;
        }

        return $totalKegiatanHasReport;
    }

    public function getDataset($currentMonth, $currentYear){
        $dataListDesa = $this->getAllDesa();
        $dataset = [];
        $dataListProgram = $this->getListLablesProgram();
        foreach($dataListDesa as $idDesa){
            $listTotalKegiatanHasReport = [];
            foreach($dataListProgram as $idProgram){
                $listIdKegiatan = $this->getListIdKegiatanByIdProgram($idProgram->id);
                $totalKegiatanHasReportForeachProgram = $this->getTotalKegiatanDoneReportByIdDesaAndKegiatan($idDesa->id, $listIdKegiatan, $currentMonth, $currentYear);
                array_push($listTotalKegiatanHasReport, $totalKegiatanHasReportForeachProgram);
            }
            $datasetItem = $this->createModelItem($idDesa->namaDesa, $listTotalKegiatanHasReport);
            array_push($dataset, $datasetItem);
        }

        // dd($dataset);

        return $dataset;
    }

    public function createModelItem($desaName, $listTotalKegiatanHasReportForeachProgram,  ){
        return [
            AppConst::LABEL => $desaName,
            AppConst::DATA => $listTotalKegiatanHasReportForeachProgram, // Pastikan kolom `data` di database sudah berupa JSON array
            AppConst::BORDER_COLOR => AppConst::randomColor(),
            AppConst::BACKGROUND_COLOR => AppConst::randomColorWithOpacity(),
            AppConst::POINT_BACKGROUND_COLOR => AppConst::randomColor(),
            AppConst::POINT_HOVER_RADIUS => 4,
            AppConst::POINT_RADIUS => 3
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.radar-chart-kia-gizi');
    }
}
