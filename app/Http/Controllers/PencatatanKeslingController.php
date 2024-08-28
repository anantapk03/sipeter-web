<?php

namespace App\Http\Controllers;

use App\Models\KegiatanKesehatanKeliling;
use App\Models\PencatatanKegiatanKesling;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PencatatanKeslingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    

    public function getMonth(int $currentMonthNumber){
        // Mapping month numbers to Indonesian month names
        $indonesianMonths = [
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
            12 => 'Desember',
        ];

        // Get the current month name in Indonesian
        return $indonesianMonths[$currentMonthNumber];

    }

    // fungsi untuk mendapatkan bulan dari nilai

    /**
     * Display a listing of the resource.
     */
    public function indexReport(Request $request)
    {
        // get month number from input
        $month = $request->bulan;
        // kondisi pemilihan bulan
        if($month){
            $data = DB::table('pencatatan_data_kesling')->select('kegiatan_kesling.*', 'pencatatan_data_kesling.*')
            ->leftJoin('kegiatan_kesling', 'pencatatan_data_kesling.idKegiatanKesling', '=', 'kegiatan_kesling.id')
            ->where('pencatatan_data_kesling.bulan', $month )
            ->get();
        }else{
            $data = DB::table('pencatatan_data_kesling')->select('kegiatan_kesling.*', 'pencatatan_data_kesling.*')
            ->leftJoin('kegiatan_kesling', 'pencatatan_data_kesling.idKegiatanKesling', '=', 'kegiatan_kesling.id')
            ->get();
        }
        
        // mendapatkan tanggal saat ini dan bulan terakhir
        $currentDay = date('j');
        $lastMonth = date('F', strtotime('+1'));

        // set default current month 
        $currentMonthNumber = Carbon::now()->month;
        $currentMonthName = $this->getMonth($currentMonthNumber);

        // rules update laporan
        

        return view('admin.ukm-essensial.kesehatan-lingkungan.pencatatan-kesling.report', ['data' => $data, 'month' => $month, 'monthName' => $currentMonthName, 'monthNumber' => $currentMonthNumber]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // get number month
        $currentMonthNumber = Carbon::now()->month;

        // get name month from function get_month
        $currentMonthName = $this->getMonth($currentMonthNumber);
        // Ambil ID kegiatan yang sudah diinputkan sebelumnya
        $alreadyInputtedIds = PencatatanKegiatanKesling::pluck('idKegiatanKesling')->toArray(); // Ganti SomeModel dengan model yang menyimpan input sebelumnya

        // Filter data kegiatan yang belum diinputkan
        $data = KegiatanKesehatanKeliling::whereNotIn('id', $alreadyInputtedIds)->get();
        #$data = KegiatanKesehatanKeliling::all();
        #dd($data);
        return view('admin.ukm-essensial.kesehatan-lingkungan.pencatatan-kesling.create', compact('data','currentMonthName'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // set to indonesian name

        $currentMonth = Carbon::now()->month;

        PencatatanKegiatanKesling::create([
            'idKegiatanKesling' => $request->kegiatan,
            'deskripsi' => $request->deskripsi,
            'jumlah' => $request->jumlah,
            'bulan' => $currentMonth,
            'tahun' => 2024
        ]);

        return redirect()->route('kesling.kegiatan.report');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = PencatatanKegiatanKesling::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = DB::table('pencatatan_data_kesling')
        ->select(
            'kegiatan_kesling.kegiatan', 
            'pencatatan_data_kesling.*', 
            'kegiatan_kesling.id as idKegiatanKesling'
            )
        ->leftJoin('kegiatan_kesling', 'pencatatan_data_kesling.idKegiatanKesling', '=', 'kegiatan_kesling.id')
        ->where('pencatatan_data_kesling.id', $id)
        ->first();

        #dd($data);
        return view('admin.ukm-essensial.kesehatan-lingkungan.pencatatan-kesling.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $bulan = Carbon::now()->month;

        $data = PencatatanKegiatanKesling::findOrFail($id);
        $data->deskripsi = $request->deskripsi;
        $data->jumlah = $request->jumlah;
        $data->bulan = $bulan;

        try{
            $data->update();
            $tag = "success";
            $message = "Berhasil ubah data!";
        }catch(Exception $e){
            $tag = 'error';
            $message = $e->getMessage();
        }

        return redirect()->route('kesling.kegiatan.report')->with($tag, $message);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = PencatatanKegiatanKesling::findOrFail($id);
        try{
            $data->delete();
            $tag = "success";
            $message = "Berhasil hapus data!";
        }catch(Exception $e){
            $tag = 'error';
            $message = $e->getMessage();
        }

        return redirect()->route('kesling.kegiatan.report')->with($tag, $message);

    }
    
}
