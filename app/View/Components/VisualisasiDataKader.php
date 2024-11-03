<?php

namespace App\View\Components;

use App\Models\DataUkbm;
use App\Models\JenisUkbm;
use Exception;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class VisualisasiDataKader extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->jenisUkbm = $this->getJenisUkbm()->pluck('jenisUkbm')->toArray();
        $this->listJumlahKader = $this->getJumlahKader()->pluck('jumlahKader')->toArray();
        $this->jumlahKaderDilatih = $this->getJumlahKader()->pluck('jumlahKaderDilatih')->toArray();
    }


    public $jenisUkbm;
    public $listJumlahKader;
    public $jumlahKaderDilatih;


    
    public function getJenisUkbm(){
        try{
            $data = JenisUkbm::all();
            return $data;
        }catch(Exception $e){
            return 0;
        }
    }
    public function getJumlahKader(){
        $listidJenis = $this->getJenisUkbm()->pluck('id')->toArray();
        try{
            $jumlahKader = DataUkbm::whereIn('idJenisUkbm', $listidJenis)->get();
            return $jumlahKader;
            //dd($jumlahKader);
        }catch(Exception $e){
            return 0;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.visualisasi-data-kader');
    }
}
