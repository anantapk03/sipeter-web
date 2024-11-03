<?php

namespace App\View\Components;

use App\Models\DataUkbm;
use Closure;
use Exception;
use App\Models\JenisUkbm;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class VisualisasiDataDana extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->listPembiayaan = $this->getSumberDana()
            ->pluck('sumberPembiayaan')
            ->unique()
            ->values()
            ->toArray();

        $this->persentasePembiayaan = $this->persentaseBiaya();
    }

    public $persentasePembiayaan;

    public $listPembiayaan;

    public function getJenisUkbm(){
        try{
            $data = JenisUkbm::all();
            return $data;
        }catch(Exception $e){
            return 0;
        }
    }

    public function getSumberDana(){
        $listId = $this->getJenisUkbm()->pluck('id')->toArray();
        try{
            $data = DataUkbm::whereIn('idJenisUkbm', $listId)->get();
            return $data;
            // dd($data);
        }catch(Exception $e){
            return 0;
        }
    }

    public function persentaseBiaya(){
        $sumberDana = $this->getSumberDana()->pluck('sumberPembiayaan');
        // hitung sumber dana
        $count = $sumberDana->countBy();
        // hitung keseluruhan sumber dana
        $totalCount = $sumberDana->count();
        // Kalkulasi persentase sumberPembiayaan
        $percentages = $count->map(function($count) use ($totalCount) {
            return round(($count / $totalCount) * 100, 2); // Calculate percentage
        });

        // dd($percentages);
        return $percentages->values()->toArray();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.visualisasi-data-dana');
    }
}
