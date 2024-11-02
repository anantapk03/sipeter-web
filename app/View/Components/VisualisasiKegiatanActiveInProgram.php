<?php

namespace App\View\Components;

use App\helpers\MonthHelper;
use App\Models\KegiatanProgramKiaGizi;
use App\Models\ProgramKiaGizi;
use Closure;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class VisualisasiKegiatanActiveInProgram extends Component
{
    /**
     * Create a new component instance.
     */

    public $currentMonth;
    public $currentYear;
    public $listLabelProgram;
    public $listTotalKegiatanActive;
    public function __construct($month = null, $year = null)
    {
        $this->currentMonth = $month ?? MonthHelper::logicGetMonth();
        $this->currentYear = $year ?? MonthHelper::checkYear();
        $this->listLabelProgram = $this->getListLablesProgram()->pluck('namaProgram')->toArray();
        $this->listTotalKegiatanActive = $this->getListTotalKegiatanInProgram();
    }

    public function getListLablesProgram(){
        try{
            $data = ProgramKiaGizi::where('isActive', true)->get();
            return $data;
        } catch(Exception $e){
            return collect();
        }
    }

    public function getTotalKegiatanInProgramById($idProgram){
        try {
            $data = KegiatanProgramKiaGizi::where('idProgramKiaGizi', $idProgram)->where('isActive', true)->get()->pluck('id')->toArray();
           return $data; 
        } catch (Exception $e) {
            return [];
        }
    }

    public function getListTotalKegiatanInProgram(){
        $dataProgram = $this->getListLablesProgram();
        $dataListTotalKegiatanInProgram = [];

        try{
            foreach($dataProgram as $idProgram){
                $listIdKegiatanByIdProgram = $this->getTotalKegiatanInProgramById($idProgram->id);
                $totalKegiatan = count($listIdKegiatanByIdProgram);
                array_push($dataListTotalKegiatanInProgram, $totalKegiatan);
            }
    
            return $dataListTotalKegiatanInProgram;
        } catch(Exception $e){
            return [];
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.visualisasi-kegiatan-active-in-program');
    }
}
