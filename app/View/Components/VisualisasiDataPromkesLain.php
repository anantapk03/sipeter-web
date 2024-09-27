<?php

namespace App\View\Components;

use App\Models\KegiatanProgramPromkes;
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

    public function __construct()
    {
        $this->listProgramPromkes = $this->listPromkes()->pluck('namaProgram')->toArray();
        $this->totalKegiatan = $this->getTotalKegiatan();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.visualisasi-data-promkes-lain');
    }
}
