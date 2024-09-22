<?php

namespace App\Http\Controllers\ukm_imunisasi\imunisasi_bayi;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\LaporanImunisasiBayi;
use App\Models\SasaranImunisasiBayi;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class SasaranImunisasiBayiController extends Controller
{

    public function getMonth(int $monthNumber){
        $bulanIndonesia = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];
        return $bulanIndonesia[$monthNumber];
    }

    public function logicGetMonth(){
        $currentMonth = Carbon::now()->month;
        $currentDay = date('j');

        if($currentDay < 5){
            $currentMonth = $currentMonth - 1;
        }
        return $currentMonth;
    }

    public function checkYear(){
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

    public function checkSasaranReport(){
        $currentMonth = $this->logicGetMonth();
        $currentYear = $this->checkYear();

        $dataDesaInSasaranInThisMonthAndYear = SasaranImunisasiBayi::where('bulan', $currentMonth)->where('tahun', $currentYear)
        ->pluck('idDesa'); 
        $desa = Desa::whereNotIn('id', $dataDesaInSasaranInThisMonthAndYear)->get();

        return $desa;
    }

    public function index(){
        $currentMonth = $this->logicGetMonth();
        $currentYear = $this->checkYear();
        $monthName = $this->getMonth($currentMonth);
        $desa = $this->checkSasaranReport();
        $data = SasaranImunisasiBayi::where('bulan', $currentMonth)->where('tahun', $currentYear)->get();
        return view('admin.ukm-essensial.pengendalian-penyakit.imunisasi.imunisasi_bayi.index', ['data' => $data, 'desa'=>$desa, 'monthName'=>$monthName, 'year'=>$currentYear]);
    }

    public function create(){
        $currentMonth = $this->logicGetMonth();
        $currentYear = $this->checkYear();
        $monthName = $this->getMonth($currentMonth);
        $desa = $this->checkSasaranReport();
        return view('admin.ukm-essensial.pengendalian-penyakit.imunisasi.imunisasi_bayi.create', ['desa' => $desa, 'monthName'=>$monthName, 'year'=>$currentYear]);
    }

    public function store(Request $request){
        $data = new SasaranImunisasiBayi();
        $currentMonth = $this->logicGetMonth();
        $currentYear = $this->checkYear();
        

        $data->idDesa = $request->idDesa;
        $data->jumlah_sasaran_bayi_laki = $request->jumlah_sasaran_bayi_laki;
        $data->jumlah_sasaran_bayi_perempuan = $request->jumlah_sasaran_bayi_perempuan;
        $data->jumlah_surviving_infant_laki = $request->jumlah_surviving_infant_laki;
        $data->jumlah_surviving_infant_perempuan = $request->jumlah_surviving_infant_perempuan;
        $data->bulan = $currentMonth;
        $data->tahun = $currentYear;

        try{
            $data->save();
            $tag = "success";
            $message = "Data berhasil dimasukan";
        } catch(Exception $e){
            $tag = "error";
            $message = $e->getMessage();
        }

        return redirect()->route('pengendalian-penyakit-imunisai-imunisasi-bayi-index')->with($tag, $message);

    }

    
    public function edit($id){
        try{
            $data = SasaranImunisasiBayi::findOrFail($id);
        } catch(Exception $e){
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        $currentMonth = $this->logicGetMonth();
        $currentYear = $this->checkYear();
        $monthName = $this->getMonth($currentMonth);
        $desa = $this->checkSasaranReport();
        return view('admin.ukm-essensial.pengendalian-penyakit.imunisasi.imunisasi_bayi.edit', ['desa' => $desa, 'monthName'=>$monthName, 'year'=>$currentYear, 'data'=>$data]);
    }

    public function update(Request $request, $id){
        try {
            $data = SasaranImunisasiBayi::findOrFail($id);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        
        $data->jumlah_sasaran_bayi_laki = $request->jumlah_sasaran_bayi_laki;
        $data->jumlah_sasaran_bayi_perempuan = $request->jumlah_sasaran_bayi_perempuan;
        $data->jumlah_surviving_infant_laki = $request->jumlah_surviving_infant_laki;
        $data->jumlah_surviving_infant_perempuan = $request->jumlah_surviving_infant_perempuan;

        try{
            $data->update();
            $tag = "success";
            $message = "Data berhasil diperbarui";
        } catch(Exception $e){
            $tag = "error";
            $message = $e->getMessage();
        }

        return redirect()->route('pengendalian-penyakit-imunisai-imunisasi-bayi-index')->with($tag, $message);

    }

    public function archieves(){
        $desa = Desa::all();
        $data = LaporanImunisasiBayi::all();
        return view('admin.ukm-essensial.pengendalian-penyakit.imunisasi.imunisasi_bayi.arsip', ['desa' => $desa, 'data'=>$data]);
    }



}
