<?php

namespace App\Http\Controllers\ukm_kia_gizi;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\KegiatanProgramKiaGizi;
use App\Models\PencatatanKegiatanProgramKiaGizi;
use App\Models\ProgramKiaGizi;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class PencatatanKegiatanProgramKiaGiziController extends Controller
{

    // UTILS 
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


    public function index($id, $idKegiatan)
    {
        $currentMonth = $this->logicGetMonth();
        $currentYear = $this->checkYear($currentMonth);
        $data = PencatatanKegiatanProgramKiaGizi::where('idKegiatanProgramKiaGizi', $idKegiatan)->leftJoin('wilayah_kerja', 'pencatatan_kegiatan_program_kia_gizis.idDesa', 'wilayah_kerja.id' )
        ->where('bulan', $currentMonth)->where('tahun', $currentYear)->select(
            'pencatatan_kegiatan_program_kia_gizis.id as idReport',
            'wilayah_kerja.*',
            'pencatatan_kegiatan_program_kia_gizis.*'
        )->get();
        $desa = $this->checkDesaInReport($idKegiatan);
        $dataKegiatan = KegiatanProgramKiaGizi::find($idKegiatan);
        $dataProgram = ProgramKiaGizi::find($id);
        $monthName = $this->getMonth($currentMonth);
        // dd($monthName);
        return view('admin.ukm-essensial.kia-gizi.kegiatan.pencatatan.index', ['data' => $data, 'dataKegiatan' => $dataKegiatan, 'dataProgram'=>$dataProgram, 'month'=>$monthName, 'desa'=>$desa]);
    }

    public function checkDesaInReport($IdKegiatan){
        $currentMonth = $this->logicGetMonth(); 
        // $currentMonth = (int) $currentMonth;
        $currentYear = $this->checkYear($currentMonth);

        $dataInThisMonthAndYear = PencatatanKegiatanProgramKiaGizi::where('bulan', $currentMonth)
        ->where('tahun', $currentYear)->where('idKegiatanProgramKiaGizi', $IdKegiatan)->pluck('idDesa');
        $desa = Desa::whereNotIn('id', $dataInThisMonthAndYear)->get();
        // dd ($desa);

        return $desa;
    }

    public function create($id, $idKegiatan)
    {
        $monthNumber = $this->logicGetMonth();
        // dd($monthNumber);
        $monthNameIdn = $this->getMonth($monthNumber);
        $year = $this->checkYear($monthNumber);
        $desa = $this->checkDesaInReport($idKegiatan);
        $dataKegiatan = KegiatanProgramKiaGizi::find($idKegiatan);
        return view('admin.ukm-essensial.kia-gizi.kegiatan.pencatatan.create', 
        [
            'desa' => $desa, 
            'monthName'=>$monthNameIdn, 
            'year' => $year,
            'dataKegiatan'=>$dataKegiatan
        ]);
    }

    public function store($id, $idKegiatan, Request $request)
    {
        $data = new PencatatanKegiatanProgramKiaGizi();
        $monthNumber = $this->logicGetMonth();
        $year = $this->checkYear($monthNumber);

        $data->idDesa = $request->idDesa;
        $data->idKegiatanProgramKiaGizi = $idKegiatan;
        $data->bulan = $monthNumber;
        $data->tahun = $year;
        $data->jumlah = $request->jumlah;
        $data->deskripsi = $request->deskripsi;

        try{
            $data->save();
            $tag = "success";
            $message = "Data berhasil ditambahkan";
        } catch(Exception $e){
            $tag = "error";
            $message = $e->getMessage();
        }

        return redirect()->route('pencatatan-kegiatan-program-kia-gizi-index', ['id'=>$id, 'idKegiatan'=>$idKegiatan])->with($tag, $message);
        
    }

    public function edit($id, $idKegiatan, $idPencatatan)
    {
        $data = PencatatanKegiatanProgramKiaGizi::find($idPencatatan);
        $monthNumber = $this->logicGetMonth();
        $currentDay = date('j'); 
        if($data == null){
            return redirect()->back()->with('error','Data tidak ditemukan ');
        }
        // dd($monthNumber);
        if($data->bulan == $monthNumber){
            if($currentDay > 5){
                $monthNameIdn = $this->getMonth($monthNumber);
                $year = $this->checkYear($monthNumber);
                $desa = $this->checkDesaInReport($idKegiatan);
                $dataKegiatan = KegiatanProgramKiaGizi::find($idKegiatan);
                return view('admin.ukm-essensial.kia-gizi.kegiatan.pencatatan.update', 
                [
                    'desa' => $desa, 
                    'monthName'=>$monthNameIdn, 
                    'year' => $year,
                    'dataKegiatan'=>$dataKegiatan, 
                    'data'=>$data
                ]);
            }
        }

        return redirect()->back()->with('error', "Akses edit ditutup");
    }

    public function update($id, $idKegiatan, $idPencatatan, Request $request)
    {
        $data = PencatatanKegiatanProgramKiaGizi::find($idPencatatan);

        $data->jumlah = $request->jumlah;
        $data->deskripsi = $request->deskripsi;

        try{
            $data->save();
            $tag = "success";
            $message = "Data berhasil diperbarui";
        } catch(Exception $e){
            $tag = "error";
            $message = $e->getMessage();
        }

        return redirect()->route('pencatatan-kegiatan-program-kia-gizi-index', ['id'=>$id, 'idKegiatan'=>$idKegiatan])->with($tag, $message);
        
    }

    public function destroy($id, $idKegiatan, $idPencatatan)
    {
        $data = PencatatanKegiatanProgramKiaGizi::find($idPencatatan);

        if($data != null) {
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

        return redirect()->back()->with('error', 'Data tidak ditemukan');

    }

    public function archieve($id, $idKegiatan){
        $currentMonth = $this->logicGetMonth();

        $data = PencatatanKegiatanProgramKiaGizi::where('idKegiatanProgramKiaGizi', $idKegiatan)->leftJoin('wilayah_kerja', 'pencatatan_kegiatan_program_kia_gizis.idDesa', 'wilayah_kerja.id' )
        ->select(
            'pencatatan_kegiatan_program_kia_gizis.id as idReport',
            'wilayah_kerja.*',
            'pencatatan_kegiatan_program_kia_gizis.*'
        )->get();

        $dataKegiatan = KegiatanProgramKiaGizi::find($idKegiatan);
        $dataProgram = ProgramKiaGizi::find($id);

        return view('admin.ukm-essensial.kia-gizi.kegiatan.pencatatan.archive', ['data' => $data, 'dataKegiatan' => $dataKegiatan, 'dataProgram'=>$dataProgram]);
    }


}
