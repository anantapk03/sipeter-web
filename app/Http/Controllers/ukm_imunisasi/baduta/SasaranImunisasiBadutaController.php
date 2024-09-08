<?php

namespace App\Http\Controllers\ukm_imunisasi\baduta;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\SasaranImunisasiBaduta;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class SasaranImunisasiBadutaController extends Controller
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

        $dataDesaInSasaranInThisMonthAndYear = SasaranImunisasiBaduta::where('bulan', $currentMonth)->where('tahun', $currentYear)
        ->pluck('idDesa'); 
        $desa = Desa::whereNotIn('id', $dataDesaInSasaranInThisMonthAndYear)->get();

        return $desa;
    }

    public function index(){
        $currentMonth = $this->logicGetMonth();
        $currentYear = $this->checkYear();
        $monthName = $this->getMonth($currentMonth);
        $desa = $this->checkSasaranReport();
        $data = SasaranImunisasiBaduta::where('bulan', $currentMonth)->where('tahun', $currentYear)->get();
        return view('admin.ukm-essensial.pengendalian-penyakit.imunisasi.baduta.index', ['data' => $data, 'desa'=>$desa, 'monthName'=>$monthName, 'year'=>$currentYear]);
    }

    public function create(){
        $currentMonth = $this->logicGetMonth();
        $currentYear = $this->checkYear();
        $monthName = $this->getMonth($currentMonth);
        $desa = $this->checkSasaranReport();
        return view('admin.ukm-essensial.pengendalian-penyakit.imunisasi.baduta.create', ['desa' => $desa, 'monthName'=>$monthName, 'year'=>$currentYear]);
    }

    public function store(Request $request){
        $data = new SasaranImunisasiBaduta();
        $currentMonth = $this->logicGetMonth();
        $currentYear = $this->checkYear();
        

        $data->idDesa = $request->idDesa;
        $data->sasaran_laki = $request->sasaran_laki;
        $data->sasaran_perempuan = $request->sasaran_perempuan;
        $data->deskripsi = $request->deskripsi;
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

        return redirect()->route('sasaran-imunisasi-baduta-index')->with($tag, $message);

    }

    public function edit($id){
        $currentMonth = $this->logicGetMonth();
        $currentYear = $this->checkYear();
        try{
            $data = SasaranImunisasiBaduta::findOrFail($id);
            if($data->tahun == $currentYear){
                if($data->bulan != $currentMonth){
                    return redirect()->back()->with('error', 'Your not allow to edit this data');
                }
            } else {
                return redirect()->back()->with('error', 'Your not allow to edit this data');
            }
        } catch(Exception $e){
            return redirect()->back()->with('error', 'Data Tidak Ditemukan');
        }
        $monthName = $this->getMonth($currentMonth);
        $desa = $this->checkSasaranReport();
        return view('admin.ukm-essensial.pengendalian-penyakit.imunisasi.baduta.edit', ['desa' => $desa, 'monthName'=>$monthName, 'year'=>$currentYear, 'data'=>$data]);
    }

    public function update(Request $request, $id){
        $currentMonth = $this->logicGetMonth();
        $currentYear = $this->checkYear();
        try{
            $data = SasaranImunisasiBaduta::findOrFail($id);
            if($data->tahun == $currentYear){
                if($data->bulan != $currentMonth){
                    return redirect()->back()->with('error', 'Your not allow to edit this data');
                }
            } else {
                return redirect()->back()->with('error', 'Your not allow to edit this data');
            }
        } catch(Exception $e){
            return redirect()->back()->with('error', 'Data Tidak Ditemukan');
        }
        
        $data->sasaran_laki = $request->sasaran_laki;
        $data->sasaran_perempuan = $request->sasaran_perempuan;
        $data->deskripsi = $request->deskripsi;

        try{
            $data->update();
            $tag = "success";
            $message = "Data berhasil dimasukan";
        } catch(Exception $e){
            $tag = "error";
            $message = $e->getMessage();
        }

        return redirect()->route('sasaran-imunisasi-baduta-index')->with($tag, $message);

    }


}
