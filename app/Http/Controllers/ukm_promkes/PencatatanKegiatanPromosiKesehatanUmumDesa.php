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
        $lastMonth = date('F', strtotime('-1 month'));

        // Set variabel bulan saat ini menjadi true
        $months[$currentMonth] = true;

        // Jika tanggal saat ini tidak lebih dari atau sama dengan tanggal 5, set variabel bulan selanjutnya menjadi true
        if ($currentDay <= 5) {
            $months[$lastMonth] = true;
        }else{
            $months[$currentMonth] = true;
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

    public function indexReport($idKegiatanPromkesDesa, $month){
        $year = Carbon::now()->format('Y');
        $monthNameIndonesia = $this->getMonth($month);
        $data = SubKegiatanPromosiKesehatanDesa::find($idKegiatanPromkesDesa);
        $dataReport = PencatatanKegiatanPromkesDesa::where('idKegiatanPromkesDesa', $idKegiatanPromkesDesa)->where('bulan', $month)->where('tahun', 2024)
        ->leftJoin('wilayah_kerja', 'pencatatan_kegiatan_promkes_desa.idDesa', '=', 'wilayah_kerja.id')->get();
        return view('admin.ukm-essensial.promkes.promkes-umum.promkes-desa.report-promkes-desa.report.index', ['data' => $data, 'year'=>$year, 'month'=>$monthNameIndonesia, 'monthNumber'=>$month, 'dataReport'=>$dataReport]);
        
    }

    public function createReport($idKegiatanPromkesDesa, $month){
        $desa = Desa::all();
        $subKegiatan= SubKegiatanPromosiKesehatanDesa::find($idKegiatanPromkesDesa);
        $monthNameIdn = $this->getMonth($month);
        return view('admin.ukm-essensial.promkes.promkes-umum.promkes-desa.report-promkes-desa.report.create', ['desa' => $desa, 'subKegiatan'=>$subKegiatan, 'month' => $month, 'monthNameIdn'=>$monthNameIdn]);
    }

    public function storeReport($idKegiatanPromkesDesa, $month, Request $request){
        $data = new PencatatanKegiatanPromkesDesa();
        $data->idKegiatanPromkesDesa = $idKegiatanPromkesDesa;
        $data->idDesa = $request->idDesa;
        $data->jumlah = $request->jumlah;
        $data->bulan = $month;
        // $data->tahun = 2024;
        $currentDay = date('j');   // Tanggal saat ini, misal: 1, 2, 3, ..., 31
        $currentYear = date('y');   // Tanggal saat ini, misal: 1, 2, 3, ..., 31

        if($month==1){
            if($currentDay>5){
                $data->tahun = $currentYear ;
            } else{
                $data->tahun = $currentYear - 1;
            }
        } 
        else{
            $data->tahun = $currentYear;
        }
        

        try{
            $data->save();
            return redirect(route('pencatatan-program-kegiatan-promkes-desa-create', ['id'=>$idKegiatanPromkesDesa, 'month'=>$month]))->with('success', 'Data berhasil ditambahkan');
        } catch(Exception $e){
            return redirect(route('pencatatan-program-kegiatan-promkes-desa-create', ['id'=>$idKegiatanPromkesDesa, 'month'=>$month]))->with('error', $e->getMessage());            
        }

    }





    
    

}
