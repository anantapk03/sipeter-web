<?php

namespace App\Http\Controllers\ukm_promkes;

use App\Http\Controllers\Controller;
use App\Models\KegiatanProgramPromkes;
use App\Models\PencatatanKegiatanProgramPromkes;
use App\Models\ProgramDivisiPromkes;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class PencatatanKegiatanProgramPromkesController extends Controller
{
    
    public function checkMonth()
    {
        // Inisialisasi variabel boolean untuk setiap bulan dalam setahun
        $months = [
            'January' => false,
            'February' => false,
            'March' => false,
            'April' => false,
            'May' => false,
            'June' => false,
            'July' => false,
            'August' => false,
            'September' => false,
            'October' => false,
            'November' => false,
            'December' => false,
        ];

        // Mendapatkan bulan dan tanggal saat ini
        $currentMonth = date('F'); // Nama bulan, misal: January, February, dll
        $currentDay = date('j');   // Tanggal saat ini, misal: 1, 2, 3, ..., 31

        // Mendapatkan bulan selanjutnya
        // $nextMonth = date('F', strtotime('+1 month'));
        $lastMonth = date('F', strtotime('-1 month'));
        

        // Jika tanggal saat ini tidak lebih dari atau sama dengan tanggal 5, set variabel bulan selanjutnya menjadi true
        if($currentMonth == "January"){
            if ($currentDay <= 5) {
                $months["December"] = true;
            } else{
                $months[$currentMonth] = true;
            }
        } else {
            if ($currentDay <= 5) {
                $months[$lastMonth] = true;
            } else{
                $months[$currentMonth] = true;
            }
        }

        // Pemetaan nama bulan ke nomor bulan
        $monthNumbers = [
            'January' => 1,
            'February' => 2,
            'March' => 3,
            'April' => 4,
            'May' => 5,
            'June' => 6,
            'July' => 7,
            'August' => 8,
            'September' => 9,
            'October' => 10,
            'November' => 11,
            'December' => 12,
        ];

        // Konversi nama bulan menjadi nomor bulan
        $monthsWithNumbers = [];
        foreach ($months as $month => $status) {
            $monthNumber = $monthNumbers[$month];
            $monthsWithNumbers[$monthNumber] = [
                'name' => $month,
                'status' => $status,
            ];
        }

        // Pisahkan bulan aktif dan tidak aktif
        $activeMonths = [];
        $inactiveMonths = [];
        foreach ($monthsWithNumbers as $monthNumber => $monthData) {
            if ($monthData['status']) {
                $activeMonths[$monthNumber] = $monthData;
            } else {
                $inactiveMonths[$monthNumber] = $monthData;
            }
        }

        // Gabungkan bulan aktif di posisi paling atas
        $sortedMonths = $activeMonths + $inactiveMonths;


        
        // Kirim data bulan ke view
        return $sortedMonths;
    }

    public function checkYear($month){
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

    public function getCurrentNumberMonth(){
        $currentDay = date('j');   // Tanggal saat ini, misal: 1, 2, 3, ..., 31
        if($currentDay > 5){
            $month = Carbon::now()->month;
        } else{
            $month = date('F', strtotime('-1 month'));
        }

        return $month;
    }

    public function indexMonth($id, $idKegiatan){
        $month = $this->getCurrentNumberMonth();
        $year = $this->checkYear($month);
        $dataKegiatan = KegiatanProgramPromkes::find($idKegiatan);
        $dataProgram = ProgramDivisiPromkes::find($id);
        $dataPencatatan = PencatatanKegiatanProgramPromkes::where('idKegiatanProgramPromkes', $idKegiatan)->where('tahun', $year)->orderBy('bulan', 'desc')->get();
        $bulanArray = $dataPencatatan->pluck('bulan')->toArray();
        $isReportThisMonthDone = in_array($month, $bulanArray);
        
        
        return view('admin.ukm-essensial.promkes.promkes-other.pencatatan.month', ['year'=>$year, "month"=>$month ,'dataKegiatan'=>$dataKegiatan, 'dataProgram'=>$dataProgram, 'dataPencatatan'=>$dataPencatatan, 'isReportThisMonthDone'=>$isReportThisMonthDone]);
    }

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

    public function create($id, $idKegiatan){
        $month = $this->getCurrentNumberMonth();
        $year = $this->checkYear($month);

        $dataKegiatan = KegiatanProgramPromkes::find($idKegiatan);
        $dataProgram = ProgramDivisiPromkes::find($id);
        
        $dataPencatatan = PencatatanKegiatanProgramPromkes::where('idKegiatanProgramPromkes', $idKegiatan)->where('tahun', $year)->orderBy('bulan', 'desc')->get();
        $bulanArray = $dataPencatatan->pluck('bulan')->toArray();
        $isReportThisMonthDone = in_array($month, $bulanArray);

        if($isReportThisMonthDone){
            return redirect()->back()->with('error', 'Anda sudah membuat report untuk bulan ini');
        }

        return view('admin.ukm-essensial.promkes.promkes-other.pencatatan.create', ['dataKegiatan'=>$dataKegiatan, 'dataProgram'=>$dataProgram, 'month'=>$month]);
        

    }

    public function store($id, $idKegiatan, Request $request){
        $data = new PencatatanKegiatanProgramPromkes();
        $data->idKegiatanProgramPromkes = $idKegiatan;
        $data->deskripsi = $request->deskripsi;
        $data->jumlah = $request->jumlah;
        $data->bulan = $this->getCurrentNumberMonth();
        $data->tahun = $this->checkYear($this->getCurrentNumberMonth());
        
        try {
            $data->save();
            $tag = "success";
            $message = "Data berhasil ditambahkan";
        } catch(Exception $e){
            $tag = "error";
            $message = $e->getMessage();
        }

        return redirect()->route('report-activity-promkes-month', ['id'=>$id, 'idKegiatan'=>$idKegiatan])->with($tag, $message);
    }

    public function destroy($id, $idKegiatan, $idPencatatan){
        $data = PencatatanKegiatanProgramPromkes::find($idPencatatan);

        $month = $this->getCurrentNumberMonth();
        $year = $this->checkYear($month);
        if($data->bulan == $month && $data->tahun != $year ){
            return redirect()->back()->with('error', 'Kamu tidak diperkenankan untuk menghapus data');
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

    public function edit($id, $idKegiatan, $idPencatatan){
        $dataPencatatan = PencatatanKegiatanProgramPromkes::find($idPencatatan);
        $dataKegiatan = KegiatanProgramPromkes::find($idKegiatan);
        $dataProgram = ProgramDivisiPromkes::find($id);
        // $month = $this->getCurrentNumberMonth();

        return view('admin.ukm-essensial.promkes.promkes-other.pencatatan.update', ['dataPencatatan'=>$dataPencatatan, 'dataProgram'=>$dataProgram, 'dataKegiatan'=>$dataKegiatan,]);
    }

    public function update($id, $idKegiatan, $idPencatatan, Request $request){
        $dataPencatatan = PencatatanKegiatanProgramPromkes::find($idPencatatan);
        $dataPencatatan->deskripsi = $request->deskripsi;
        $dataPencatatan->jumlah = $request->jumlah;

        try{
            $dataPencatatan->update();
            $tag = "success";
            $message = "Data berhasil diperbarui";
        } catch(Exception $e){
            $tag = "error";
            $message = $e->getMessage();
        }

        return redirect()->route('report-activity-promkes-month', ['id'=>$id, 'idKegiatan'=>$idKegiatan])->with($tag, $message);
    }

}
