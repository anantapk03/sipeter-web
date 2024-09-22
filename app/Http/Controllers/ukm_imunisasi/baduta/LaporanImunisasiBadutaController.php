<?php

namespace App\Http\Controllers\ukm_imunisasi\baduta;

use App\Http\Controllers\Controller;
use App\Models\JenisImunisasiBaduta;
use App\Models\LaporanImunisasiBaduta;
use App\Models\SasaranImunisasiBaduta;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class LaporanImunisasiBadutaController extends Controller
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

    public function checkJenisImunisasiInReport($id){
        $dataReportInThisMonthAndYear = LaporanImunisasiBaduta::where('idSasaranImunisasi', $id)->pluck('idJenisImunisasi');
        $jenisImunisasi = JenisImunisasiBaduta::whereNotIn('id', $dataReportInThisMonthAndYear)->get();
        return $jenisImunisasi;
    }

    public function index($id){
        $currentMonth = $this->logicGetMonth();
        $year = $this->checkYear();

        try {
            $sasaranImuniasai = SasaranImunisasiBaduta::findOrFail($id);
            if($sasaranImuniasai->bulan == $currentMonth){
                if($sasaranImuniasai->tahun != $year){
                    return redirect()->back()->with('error', 'Anda tidak diperkenankan mengakses halaman ini');
                }
            } else {
                return redirect()->back()->with('error', 'Anda tidak diperkenankan mengakses halaman ini');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error','data tidak ditemukan');
        }
        $data = LaporanImunisasiBaduta::where('idSasaranImunisasi', $id)->get();
        $imunisasi = $this->checkJenisImunisasiInReport($id);

        return view('admin.ukm-essensial.pengendalian-penyakit.imunisasi.baduta.laporan.index', ['data'=>$data, 'imunisasi'=>$imunisasi, 'sasaran'=>$sasaranImuniasai]);
    }

    public function create($id){
        $currentMonth = $this->logicGetMonth();
        $year = $this->checkYear();
        try {
            $sasaranImuniasai = SasaranImunisasiBaduta::findOrFail($id);
            if($sasaranImuniasai->bulan == $currentMonth){
                if($sasaranImuniasai->tahun != $year){
                    return redirect()->back()->with('error', 'Anda tidak diperkenankan mengakses halaman ini');
                }
            } else {
                return redirect()->back()->with('error', 'Anda tidak diperkenankan mengakses halaman ini');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error','data tidak ditemukan');
        }

        $jenisImunisasi = $this->checkJenisImunisasiInReport($id);

        return view('admin.ukm-essensial.pengendalian-penyakit.imunisasi.baduta.laporan.create', ['imunisasi'=>$jenisImunisasi, 'sasaran'=>$sasaranImuniasai]);
    }

    public function store($id, Request $request){
        $currentMonth = $this->logicGetMonth();
        $year = $this->checkYear();
        try {
            $sasaranImuniasai = SasaranImunisasiBaduta::findOrFail($id);
            if($sasaranImuniasai->bulan == $currentMonth){
                if($sasaranImuniasai->tahun != $year){
                    return redirect()->back()->with('error', 'Anda tidak diperkenankan mengakses halaman ini');
                }
            } else {
                return redirect()->back()->with('error', 'Anda tidak diperkenankan mengakses halaman ini');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error','data tidak ditemukan');
        }

        $data = new LaporanImunisasiBaduta();

        $data->idJenisImunisasi= $request->idJenisImunisasi;
        $data->idSasaranImunisasi= $id;
        $data->jumlah_laki= $request->jumlah_laki;
        $data->jumlah_perempuan= $request->jumlah_perempuan;
        $data->deskripsi= $request->deskripsi;

        
        try{
            $data->save();
            $tag = "success";
            $message = "Data berhasil ditambahkan";
        } catch(Exception $e){
            $tag = "error";
            $message = $e->getMessage();
        }

        return redirect()->route('laporan-imunisasi-baduta-index', ['id'=>$id])->with($tag, $message);

    }

    public function edit($id, $idLaporan){
        $currentMonth = $this->logicGetMonth();
        $year = $this->checkYear();
        try {
            $sasaranImuniasai = SasaranImunisasiBaduta::findOrFail($id);
            $data = LaporanImunisasiBaduta::findOrFail($idLaporan);
            if($sasaranImuniasai->bulan == $currentMonth){
                if($sasaranImuniasai->tahun != $year){
                    return redirect()->back()->with('error', 'Anda tidak diperkenankan mengakses halaman ini');
                }
            } else {
                return redirect()->back()->with('error', 'Anda tidak diperkenankan mengakses halaman ini');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error','data tidak ditemukan');
        }

        $jenisImunisasi = $this->checkJenisImunisasiInReport($id);
        

        return view('admin.ukm-essensial.pengendalian-penyakit.imunisasi.baduta.laporan.update', ['imunisasi'=>$jenisImunisasi, 'sasaran'=>$sasaranImuniasai, 'data'=>$data]);
    }

    public function update($id, $idLaporan, Request $request){
        $currentMonth = $this->logicGetMonth();
        $year = $this->checkYear();
        try {
            $sasaranImuniasai = SasaranImunisasiBaduta::findOrFail($id);
            $data = LaporanImunisasiBaduta::findOrFail($idLaporan);
            if($sasaranImuniasai->bulan == $currentMonth){
                if($sasaranImuniasai->tahun != $year){
                    return redirect()->back()->with('error', 'Anda tidak diperkenankan mengakses halaman ini');
                }
            } else {
                return redirect()->back()->with('error', 'Anda tidak diperkenankan mengakses halaman ini');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error','data tidak ditemukan');
        }        

        $data->jumlah_laki= $request->jumlah_laki;
        $data->jumlah_perempuan= $request->jumlah_perempuan;
        $data->deskripsi= $request->deskripsi;

        try{
            $data->update();
            $tag = "success";
            $message = "Data berhasil ditambahkan";
        } catch(Exception $e){
            $tag = "error";
            $message = $e->getMessage();
        }

        return redirect()->route('laporan-imunisasi-baduta-index', ['id'=>$id])->with($tag, $message);
    }

    public function destroy($id, $idLaporan){
        $currentMonth = $this->logicGetMonth();
        $year = $this->checkYear();
        try {
            $sasaranImuniasai = SasaranImunisasiBaduta::findOrFail($id);
            $data = LaporanImunisasiBaduta::findOrFail($idLaporan);
            if($sasaranImuniasai->bulan == $currentMonth){
                if($sasaranImuniasai->tahun != $year){
                    return redirect()->back()->with('error', 'Anda tidak diperkenankan mengakses halaman ini');
                }
            } else {
                return redirect()->back()->with('error', 'Anda tidak diperkenankan mengakses halaman ini');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error','data tidak ditemukan');
        }

        try{
            $data->delete();
            $tag = "success";
            $message = "Data berhasil dihapus";
        } catch(Exception $e){
            $tag = "error";
            $message = $e->getMessage();
        }

        return redirect()->back()->with($tag, $message);

    }

}
