<?php

namespace App\Http\Controllers\ukm_promkes;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\PencatatanKegiatanPromkesDesa;
use App\Models\SubKegiatanPromosiKesehatanDesa;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use IntlDateFormatter;

class PencatatanKegiatanPromosiKesehatanUmumDesa extends Controller
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

    public function index($id){
        $year = Carbon::now()->format('Y');
        $monthInYearCondition = $this->checkMonth();
        // dd($monthInYearCondition);
        $data = SubKegiatanPromosiKesehatanDesa::find($id);
        return view('admin.ukm-essensial.promkes.promkes-umum.promkes-desa.report-promkes-desa.index', ['data' => $data, 'year'=>$year, 'monthInYearCondition' =>$monthInYearCondition]);
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

    public function indexReport($idKegiatanPromkesDesa, $month, $status){
        $year = Carbon::now()->format('Y');
        $status = filter_var($status, FILTER_VALIDATE_BOOLEAN);
        $monthNameIndonesia = $this->getMonth($month);
        $isReportDone = $this->checkDesaInReport($month, $idKegiatanPromkesDesa);
        $data = SubKegiatanPromosiKesehatanDesa::find($idKegiatanPromkesDesa);
        $year = $this->checkYear($month);
        $dataReport = PencatatanKegiatanPromkesDesa::where('idKegiatanPromkesDesa', $idKegiatanPromkesDesa)->where('bulan', $month)->where('tahun', $year)
        ->leftJoin('wilayah_kerja', 'pencatatan_kegiatan_promkes_desa.idDesa', '=', 'wilayah_kerja.id')
        ->select(
            'pencatatan_kegiatan_promkes_desa.id as idReport',
            'wilayah_kerja.*', // Mengambil semua kolom dari wilayah_kerja
            'pencatatan_kegiatan_promkes_desa.*' // Mengambil semua kolom dari pencatatan_kegiatan_promkes_desa
        )->get();
        return view('admin.ukm-essensial.promkes.promkes-umum.promkes-desa.report-promkes-desa.report.index', ['data' => $data, 'year'=>$year, 'month'=>$monthNameIndonesia, 'monthNumber'=>$month, 'dataReport'=>$dataReport, 'status'=>$status, 'isReportDone'=>$isReportDone]);
        
    }

    public function createReport($idKegiatanPromkesDesa, $month, $status){
        // dd($status);
        // dd($desa);
        $desa = $this->checkDesaInReport($month, $idKegiatanPromkesDesa);
        $status = filter_var($status, FILTER_VALIDATE_BOOLEAN);
        $subKegiatan= SubKegiatanPromosiKesehatanDesa::find($idKegiatanPromkesDesa);
        $monthNameIdn = $this->getMonth($month);
        return view('admin.ukm-essensial.promkes.promkes-umum.promkes-desa.report-promkes-desa.report.create', ['desa' => $desa, 'subKegiatan'=>$subKegiatan, 'month' => $month, 'monthNameIdn'=>$monthNameIdn, 'status'=>$status]);
    }

    public function checkDesaInReport($month, $idKegiatanPromkesDesa){
        $currentMonth = $month;
        $currentYear = $this->checkYear($currentMonth);
        $desaInThisMonthandYear = PencatatanKegiatanPromkesDesa::where('bulan', $currentMonth)->where('tahun', $currentYear)->where('idKegiatanPromkesDesa',$idKegiatanPromkesDesa )->pluck('idDesa');
        $desa = Desa::whereNotIn('id', $desaInThisMonthandYear)->get();
        return $desa;
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

    public function storeReport($idKegiatanPromkesDesa, $month, $status, Request $request){
        $data = new PencatatanKegiatanPromkesDesa();
        $data->idKegiatanPromkesDesa = $idKegiatanPromkesDesa;
        $data->idDesa = $request->idDesa;
        $data->jumlah = $request->jumlah;
        $data->bulan = $month;
        $data->deskripsi = $request->deskripsi;
        

        $data->tahun = $this->checkYear($month);
        $status = filter_var($status, FILTER_VALIDATE_BOOLEAN);

        try{
            $data->save();
            $tag = "success";
            $message = "Data berhasil ditambahkan";
        } catch(Exception $e){
            $tag = "error";         
            $message = $e->getMessage();
        }
        return redirect(route('pencatatan-program-kegiatan-promkes-desa-create', ['id'=>$idKegiatanPromkesDesa, 'month'=>$month, 'status'=>$status]))->with($tag, $message);

    }

    public function editReport($idKegiatanPromkesDesa, $month, $status, $idReport){
        // $desa = $this->checkDesaInReport($month, $idKegiatanPromkesDesa);
        $status = filter_var($status, FILTER_VALIDATE_BOOLEAN);
        $subKegiatan= SubKegiatanPromosiKesehatanDesa::find($idKegiatanPromkesDesa);
        $monthNameIdn = $this->getMonth($month);
         // Perbaiki query dengan menggunakan alias tabel
        $data = PencatatanKegiatanPromkesDesa::leftJoin('wilayah_kerja', 'pencatatan_kegiatan_promkes_desa.idDesa', '=', 'wilayah_kerja.id')
        ->where('pencatatan_kegiatan_promkes_desa.id', $idReport)
        ->select(
            'pencatatan_kegiatan_promkes_desa.id as idReport',
            'wilayah_kerja.*', // Mengambil semua kolom dari wilayah_kerja
            'pencatatan_kegiatan_promkes_desa.*' // Mengambil semua kolom dari pencatatan_kegiatan_promkes_desa
        )
        ->first();
            
        return view('admin.ukm-essensial.promkes.promkes-umum.promkes-desa.report-promkes-desa.report.update', ['subKegiatan'=>$subKegiatan, 'month' => $month, 'monthNameIdn'=>$monthNameIdn, 'status'=>$status, 'data'=>$data]);
    }

    public function updateReport($idKegiatanPromkesDesa, $month, $status, $idReport, Request $request)
    {
        $data = PencatatanKegiatanPromkesDesa::find($idReport);
        $data->jumlah = $request->jumlah; 
        $data->deskripsi = $request->deskripsi; 
        
        try{
            $data->update();
            $tag= "success";
            $message = "Data berhasil diperbarui";
        } catch(Exception $e) {
            $tag = "error";
            $message = $e->getMessage();
        }

        return redirect(route('pencatatan-program-kegiatan-promkes-desa-create', ['id'=>$idKegiatanPromkesDesa, 'month'=>$month, 'status'=>$status]))->with($tag, $message);

    }

    public function deleteReport($idReport){
        $data = PencatatanKegiatanPromkesDesa::find($idReport);
        try{
            $data->delete();
            $tag= "success";
            $message = "Data berhasil dihapus";
        } catch(Exception $e){
            $tag = "error";
            $message = $e->getMessage();
        }

        return redirect()->back()->with($tag, $message);

    }





    
    

}
