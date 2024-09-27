<?php

namespace App\View\Components;

use App\Models\JenisUkbm;
use App\Models\PencatatanKegiatanPromkesDesa;
use Closure;
use Exception;
use Carbon\Carbon;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use App\Models\SubKegiatanPromosiKesehatanDesa;

class VisualisasiDataPromkesUmum extends Component
{
    /**
     * Create a new component instance.
     */
    
    public $listKegiatan;
    public $jumlahCapaian;
    public $targetKegiatan;
    public $jumlahDesa;
    public $month;
    public $year;

    public function getListKegiatan(){
        try{
            $data = SubKegiatanPromosiKesehatanDesa::where('isActive', true)->get();
            return $data;
        }catch(Exception $e){
            return collect();
        }
    }

    
    public function getYear(){
        $currentDay = date('j');   // Tanggal saat ini, misal: 1, 2, 3, ..., 31
        $currentYear = date('Y');   // Tanggal saat ini, misal: 1, 2, 3, ..., 31
        $year = $currentYear;
        $currentMonth = Carbon::now()->month;

        if($currentMonth==1){
            if($currentDay>5){
                $year = $currentYear ;
            } else{
                $year = $currentYear - 1;
            }
        }
        return $year;
    }

    public function getMonth(){
        $currentMonth = Carbon::now()->month;
        $currentDay = date('j');

        if($currentDay < 5){
            $currentMonth = $currentMonth - 1;
        }
        return $currentMonth;
    }

    public function getJumlahCapaian(){
        $listIdKegiatan = $this->getListKegiatan()->pluck('id');
        $listJumlahCapaian = [];
        $currentMonth = $this->getMonth();
        $currentYear = $this->getYear();

        for($i = 0; $i < count($listIdKegiatan); $i++){
            try{
                $data = PencatatanKegiatanPromkesDesa::where('idKegiatanPromKesDesa', $listIdKegiatan[$i])
                    ->where('bulan', $currentMonth)
                    ->where('tahun', $currentYear)
                    ->get()
                    ->pluck('jumlah')
                    ->toArray();

                $jumlah = array_sum($data);
                array_push($listJumlahCapaian, $jumlah);
            }catch(Exception $e){
                array_push($listJumlahCapaian, 0);
            }
        }

        return $listJumlahCapaian;
    }

    public function getJumlahDesa(){
        // Ambil list ID Kegiatan
        $listIdKegiatan = $this->getListKegiatan()->pluck('id')->toArray();
        $currentMonth = $this->getMonth();
        $currentYear = $this->getYear();
    
        // Inisialisasi array untuk menampung hasil
        $listJumlahDesa = [];
    
        try {
            // Looping setiap ID kegiatan dan hitung jumlah desa untuk setiap kegiatan
            foreach ($listIdKegiatan as $idKegiatan) {
                $jumlahDesa = PencatatanKegiatanPromkesDesa::where('idKegiatanPromKesDesa', $idKegiatan)
                    ->where('bulan', $currentMonth)
                    ->where('tahun', $currentYear)
                    ->count('idDesa'); // Hitung jumlah desa
    
                // Masukkan hasil hitungan ke array
                $listJumlahDesa[] = $jumlahDesa;
            }
    
            // Kembalikan array hasilnya
            return $listJumlahDesa;
            //dd($listJumlahDesa);
        } catch(Exception $e) {
            // Debugging jika ada error
            dd($e);
            return [];
        }
    }


    public function __construct()
    {
        $this->listKegiatan = $this->getListKegiatan()->pluck('namaKegiatan')->toArray();
        $this->targetKegiatan = $this->getListKegiatan()->pluck('targetBulanan')->toArray();
        $this->jumlahCapaian = $this->getJumlahCapaian();
        $this->jumlahDesa = $this->getJumlahDesa();
        $this->year = $this->getYear();
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.visualisasi-data-promkes-umum');
    }
}
