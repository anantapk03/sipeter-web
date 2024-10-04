<?php

namespace App\View\Components;

use App\Models\LaporanImunisasiWus;
use App\Models\SasaranImunisasiWus;
use Closure;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class VisualisasiDataImunisasiWus extends Component
{
    /**
     * Create a new component instance.
     */
    
    // inisialisasi variable yang diperlukan
    public $listSasaran;
    public $targetSasaran;
    public $listCapaian;



    // Mendapatkan data sasaran
    public function getListSasaran(){
        try{
            $data = SasaranImunisasiWus::leftJoin('wilayah_kerja', function ($join) {
                $join->on('sasaran_imunisasi_wus.idDesa', '=', 'wilayah_kerja.id');
            })->get();
            // dd($data);
            return $data;
        }catch(Exception $e){
            return 0;
        }
    }

    public function getSasaran(){
        try{
            $data = SasaranImunisasiWus::all();
            return $data;
        }catch(Exception $e){
            return $e;
        }
    }

    // mendapatkan jumlah pencatatan yang telah dilakukan (Capaian)
    public function getCapaianKegiatan(){
        $listIdSasaran = $this->getSasaran()->pluck('id')->toArray();
       // dd($listIdSasaran);
        $listCapaianKegiatan = [];
        try{
            foreach($listIdSasaran as $idSasaran){
                $capaian = LaporanImunisasiWus::leftJoin('sasaran_imunisasi_wus', function ($join) {
                    $join->on('laporan_imunisasi_wus.idSasaran', '=', 'sasaran_imunisasi_wus.id');
                })->where('laporan_imunisasi_wus.idSasaran', $idSasaran)
                    ->count('idSasaran');
                $listCapaianKegiatan[] = $capaian;
            }
            // dd($listCapaianKegiatan);
            return $listCapaianKegiatan;
        }catch(Exception $e){
            return 0;
        }
    }
    public function __construct()
    {
        $this->listSasaran = $this->getListSasaran()->pluck('namaDesa')->toArray();
        $this->targetSasaran = $this->getListSasaran()->pluck('jumlahSasaran')->toArray();
        $this->listCapaian = $this->getCapaianKegiatan();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.visualisasi-data-imunisasi-wus');
    }
}
