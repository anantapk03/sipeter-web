<?php

namespace App\Http\Controllers\ukm_p2;

use App\Http\Controllers\Controller;
use App\Models\KegiatanProgramPengendalianPenyakit;
use App\Models\PencatatanProgramPengendalianPenyakit;
use App\Models\ProgramPengendalianPenyakit;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class LaporanKegiatanProgramP2Controller extends Controller
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

    public function checkReportInThisMonth($idProgram){
        $currentMonth = $this->logicGetMonth();
        $year = $this->checkYear();
        try{
            $dataKegiatanAll = KegiatanProgramPengendalianPenyakit::where('idProgram',$idProgram)->where('isActive', true)->get();
            $dataKegiatan =$dataKegiatanAll->pluck('id');
            $dataLaporan = PencatatanProgramPengendalianPenyakit::whereIn('idKegiatan', $dataKegiatan)->where('tahun', $year)->where('bulan', $currentMonth)->pluck('idKegiatan');
            $unReportedKegiatan = KegiatanProgramPengendalianPenyakit::whereNotIn('id', $dataLaporan)->where('idProgram', $idProgram)->where('isActive',true)->get();
            return $unReportedKegiatan;

        } catch(Exception $e){
            return null;
        }
    }

    public function findProgram($id){
        try{
            $data = ProgramPengendalianPenyakit::findOrFail($id);
            return $data;
        } catch(Exception $e){
            return null;
        }
    }

    public function index($id){
        $currentMonth = $this->logicGetMonth();
        $year = $this->checkYear();
        $monthName = $this->getMonth($currentMonth);
        $program = $this->findProgram($id);
        $kegiatanInReport = $this->checkReportInThisMonth($id);
        if(!$program || !$kegiatanInReport){
            return redirect()->back()->with('error', 'Program not found');
        }

        try{
            $dataKegiatanAll = KegiatanProgramPengendalianPenyakit::where('idProgram',$id)->where('isActive', true)->pluck('id');
            $dataReportInThisMonth = PencatatanProgramPengendalianPenyakit::whereIn('idKegiatan', $dataKegiatanAll)->where('tahun', $year)->where('bulan', $currentMonth)->get();
        } catch(Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        return view('admin.ukm-essensial.pengendalian-penyakit.category_p2.program.laporan.index', ['program'=>$program, 'data'=>$dataReportInThisMonth, 'isReportDone'=>$kegiatanInReport, 'monthName'=>$monthName, 'year'=>$year]);
    }

    public function create($id){
        $currentMonth = $this->logicGetMonth();
        $year = $this->checkYear();
        $monthName = $this->getMonth($currentMonth);
        $program = $this->findProgram($id);
        $kegiatanInReport = $this->checkReportInThisMonth($id);
        if(!$program || !$kegiatanInReport){
            return redirect()->back()->with('error', 'Program not found');
        }

        return view('admin.ukm-essensial.pengendalian-penyakit.category_p2.program.laporan.create', ['kegiatan'=>$kegiatanInReport, 'program'=>$program, 'year'=>$year, 'monthName'=>$monthName, 'isReportDone'=>$kegiatanInReport]);
    }

    public function store($id, Request $request){
        $currentMonth = $this->logicGetMonth();
        $year = $this->checkYear();
        $program = $this->findProgram($id);
        $kegiatanInReport = $this->checkReportInThisMonth($id);
        if(!$program || !$kegiatanInReport){
            return redirect()->back()->with('error', 'Program not found');
        }

        $data = new PencatatanProgramPengendalianPenyakit();
        $data->idKegiatan = $request->idKegiatan;
        $data->jumlah = $request->jumlah;
        $data->bulan = $currentMonth;
        $data->tahun = $year;
        $data->deskripsi = $request->deskripsi;

        try{
            $data->save();
            $tag  = "success";
            $message = "Data saved successfully";
        } catch(Exception $e) {
            $tag = "error";
            $message = $e->getMessage();
        }

        return redirect()->route('laporan-kegiatan-program-p2', ['id'=>$id])->with($tag, $message);

    }

    public function edit($id, $idPencatatan){
        $currentMonth = $this->logicGetMonth();
        $year = $this->checkYear();
        $monthName = $this->getMonth($currentMonth);
        $program = $this->findProgram($id);
        $kegiatanInReport = $this->checkReportInThisMonth($id);
        if(!$program || !$kegiatanInReport){
            return redirect()->back()->with('error', 'Program not found');
        }

        try{
            $data = PencatatanProgramPengendalianPenyakit::findOrFail($idPencatatan);
        }catch(Exception $e){
            return redirect()->back()->with('error','Data does not exist');
        }

        return view('admin.ukm-essensial.pengendalian-penyakit.category_p2.program.laporan.edit', ['kegiatan'=>$kegiatanInReport, 'program'=>$program, 'year'=>$year, 'monthName'=>$monthName, 'data'=>$data]);
    }

    public function update($id, $idPencatatan, Request $request){
        try{
            $data = PencatatanProgramPengendalianPenyakit::findOrFail($idPencatatan);
        }catch(Exception $e){
            return redirect()->back()->with('error','Data does not exist');
        }

        $program = $this->findProgram($id);
        $kegiatanInReport = $this->checkReportInThisMonth($id);
        if(!$program || !$kegiatanInReport){
            return redirect()->back()->with('error', 'Program not found');
        }

        $data->jumlah = $request->jumlah;
        $data->deskripsi = $request->deskripsi;

        try{
            $data->update();
            $tag  = "success";
            $message = "Data updated successfully";
        } catch(Exception $e) {
            $tag = "error";
            $message = $e->getMessage();
        }

        return redirect()->route('laporan-kegiatan-program-p2', ['id'=>$id])->with($tag, $message);

    }

    public function destroy($id, $idPencatatan){
        try{
            $data = PencatatanProgramPengendalianPenyakit::findOrFail($idPencatatan);
        }catch(Exception $e){
            return redirect()->back()->with('error','Data does not exist');
        }

        $program = $this->findProgram($id);
        $kegiatanInReport = $this->checkReportInThisMonth($id);
        if(!$program || !$kegiatanInReport){
            return redirect()->back()->with('error', 'Program not found');
        }

        try{
            $data->delete();
            $tag  = "success";
            $message = "data deleted successfully";
        } catch(Exception $e) {
            $tag = "error";
            $message = $e->getMessage();
        }

        return redirect()->route('laporan-kegiatan-program-p2', ['id'=>$id])->with($tag, $message);

    }

    public function history($idProgram){
        $currentMonth = $this->logicGetMonth();
        $year = $this->checkYear();
        $monthName = $this->getMonth($currentMonth);
        $program = $this->findProgram($idProgram);
        $kegiatanInReport = $this->checkReportInThisMonth($idProgram);
        if(!$program || !$kegiatanInReport){
            return redirect()->back()->with('error', 'Program not found');
        }
        try{
            $dataKegiatanAll = KegiatanProgramPengendalianPenyakit::where('idProgram',$idProgram)->where('isActive', true)->get();
            $dataKegiatan =$dataKegiatanAll->pluck('id');
            $dataLaporan = PencatatanProgramPengendalianPenyakit::whereIn('idKegiatan', $dataKegiatan)->get();
            
        } catch(Exception $e){
            return redirect()->back()->with('error', 'Failed to get data');
        }

        return view('admin.ukm-essensial.pengendalian-penyakit.category_p2.program.laporan.history', ['data'=>$dataLaporan, 'monthName'=>$monthName, 'year'=>$year, 'program'=>$program]);
    }

}
