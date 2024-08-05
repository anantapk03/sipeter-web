<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\DataUkbm;
use Illuminate\Http\Request;
use App\Models\PencatatanUkbm;

class PencatatanUkbmController extends Controller
{

    // fungsi untuk mengecek bulan
    public function checkMonth(){
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
            } else {
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

    // fungsi untuk mengecek tahun
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

    // fungsi untuk mendapatkan bulan dari nilai
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

    /**
     * Display a listing of the resource.
     */
    public function indexReport()
    {
        $year = Carbon::now()->format('Y');
        $monthInYearCondition = $this->checkMonth();
        return view('admin.ukm-essensial.promkes.promkes-umum.ukbm.pencatatan-ukbm.report', ['year' => $year, 'monthInYearCondition' => $monthInYearCondition]);
    }

    public function index($month, $status)
    {
        $year = Carbon::now()->format('Y');
        $status = filter_var($status, FILTER_VALIDATE_BOOLEAN);
        $monthNameIndonesia = $this->getMonth($month);
        $year = $this->checkYear($month);
        $data = PencatatanUkbm::where('bulan', $month)->where('tahun', $year)
        ->leftJoin('data_ukbm', 'pencatatan_data_ukbm.idDataUkbm', '=', 'data_ukbm.id')
        ->select('data_ukbm.namaUkbm', 'pencatatan_data_ukbm.*', 'pencatatan_data_ukbm.id')
        ->get();
        return view('admin.ukm-essensial.promkes.promkes-umum.ukbm.pencatatan-ukbm.index', ['data' => $data, 'month' => $month, 'monthName' => $monthNameIndonesia, 'status' => $status]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($month, $status)
    {
        $dataUkbm = DataUkbm::all();
        return view('admin.ukm-essensial.promkes.promkes-umum.ukbm.pencatatan-ukbm.create', ['ukbm'=> $dataUkbm, 'month' => $month, 'status' => $status]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $month, $status)
    {
        $data = PencatatanUkbm::create([
            'idDataUkbm' => $request->dataUkbm,
            'bulan' => $month,
            'tahun' => $this->checkYear($month),
            'status'=> filter_var($status, FILTER_VALIDATE_BOOLEAN),
            'deskripsi' => $request->deskripsi
        ]);
        try{
            $tag= "success";
            $message = "Data berhasil ditambahkan";
        } catch(Exception $e) {
            $tag = "error";
            $message = $e->getMessage();
        }

        return redirect()->route('ukbm.pencatatan-ukbm.index', ['data' => $data, 'month' => $month, 'status' => $status])->with($tag, $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $month, string $status, string $id)
    {
        $status = filter_var($status, FILTER_VALIDATE_BOOLEAN);
        $monthNameIndonesia = $this->getMonth($month);
        $data = PencatatanUkbm::where('bulan', $month)->where('pencatatan_data_ukbm.id', $id)
        ->leftJoin('data_ukbm', 'pencatatan_data_ukbm.idDataUkbm', '=', 'data_ukbm.id')
        ->select('data_ukbm.namaUkbm', 'pencatatan_data_ukbm.*', 'data_ukbm.id as idDataUkbm')
        ->first();

        return view('admin.ukm-essensial.promkes.promkes-umum.ukbm.pencatatan-ukbm.edit', ['data' => $data , 'month'=> $month, 'monthName' => $monthNameIndonesia, 'status' => $status]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $month, string $status, string $id)
    {
        $data = PencatatanUkbm::findOrFail($id);
        $data->deskripsi = $request->deskripsi;
        try{
            $data->update();
            $tag= "success";
            $message = "Data berhasil diperbarui";
        } catch(Exception $e) {
            $tag = "error";
            $message = $e->getMessage();
        }

        return redirect(route('ukbm.pencatatan-ukbm.index', ['month' => $month, 'status' => $status]))->with($tag, $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $month, string $status, string $id)
    {
        $data = PencatatanUkbm::findOrFail($id);
        try{
            $data->delete();
            $tag= "success";
            $message = "Data berhasil dihapus";
        } catch(Exception $e){
            $tag = "error";
            $message = $e->getMessage();
        }

        return redirect()->route('ukbm.pencatatan-ukbm.index', ['month' => $month, 'status' => $status])->with($tag, $message);
    }
}
