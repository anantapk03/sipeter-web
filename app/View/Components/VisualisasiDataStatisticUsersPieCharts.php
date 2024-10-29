<?php

namespace App\View\Components;

use App\Models\AccessFeature;
use App\Models\Divisi;
use Closure;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class VisualisasiDataStatisticUsersPieCharts extends Component
{
    /**
     * Create a new component instance.
     */
    public $labelsDivisiPieChart;
    public $totalsUsersInDivisiPieChart;
    public function __construct()
    {
        $this->labelsDivisiPieChart = $this->getAllDivisi()->pluck('namaDivisi')->toArray();
        $this->totalsUsersInDivisiPieChart = $this->getTotalUsersInDivisi();
    }

    /**
     * Get the view / contents that represent the component.
     */

     public function getAllDivisi (){
        try{
            $data = Divisi::all();
            return $data;
        } catch(Exception $e){
            return collect();
        }
    }

    public function getTotalUsersInDivisi(){
        $dataDivisi = $this->getAllDivisi();
        $dataTotalUsers = [];
        foreach($dataDivisi as $divisi){
            $totalUsersInDivisi = $this->findTotalUsersInDivisi($divisi->id);
            array_push($dataTotalUsers, $totalUsersInDivisi);
        }
        return $dataTotalUsers;
    }

    public function findTotalUsersInDivisi($idDivisi){
        try{
            $data = AccessFeature::where('idDivisi', $idDivisi)->get()->toArray();
            $totalUsers = count($data);

            return $totalUsers;
        } catch(Exception $e){
            return 0;
        }
    }

    public function render(): View|Closure|string
    {
        return view('components.visualisasi-data-statistic-users-pie-charts');
    }
}
