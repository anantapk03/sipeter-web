<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SasaranImunisasiWus;

class SasaranImunisasiWusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
    
    public function index()
    {
        $currentMonth = $this->logicGetMonth();
        $currentYear = $this->checkYear();
        $monthName = $this->getMonth($currentMonth);
        $data = DB::table('sasaran_imunisasi_wus')
            ->leftJoin('wilayah_kerja', 'sasaran_imunisasi_wus.idDesa', '=', 'wilayah_kerja.id')
            ->select('wilayah_kerja.namaDesa', 'sasaran_imunisasi_wus.*')
            ->get();

        //dd($data);
        return view('admin.ukm-essensial.pengendalian-penyakit.imunisasi.imunisasi-wus.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Desa::all();
        return view('admin.ukm-essensial.pengendalian-penyakit.imunisasi.imunisasi-wus.sasaran-imunisasi.create', compact('data'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $currentMonth = $this->logicGetMonth();
        $currentYear = $this->checkYear();

        SasaranImunisasiWus::create([
            'idDesa' => $request->desa,
            'jumlahSasaran' => $request->jumlah,
            'bulan' => $currentMonth,
            'tahun' => $currentYear
        ]);

        try{
            $tag = 'success';
            $message = 'Berhasil menyimpan data!';
        }catch(Exception $e){
            $tag = 'error';
            $message = $e->getMessage();
        }

        return redirect()->route('imunisasi-wus.sasaran')->with($tag, $message);
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
    public function edit(string $id)
    {
        $data = DB::table('sasaran_imunisasi_wus')
            ->where('sasaran_imunisasi_wus.id', $id)
            ->leftJoin('wilayah_kerja', 'sasaran_imunisasi_wus.idDesa', '=', 'wilayah_kerja.id')
            ->select('wilayah_kerja.namaDesa', 'sasaran_imunisasi_wus.*')
            ->get();
            
        #dd($data);
        return view('admin.ukm-essensial.pengendalian-penyakit.imunisasi.imunisasi-wus.sasaran-imunisasi.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = SasaranImunisasiWus::find($id);
        $data->jumlahSasaran = $request->jumlah;
        try{
            $data->update();
            $tag = 'success';
            $message = 'Berhasil mengubah data!';
        }catch(Exception $e){
            $tag = 'error';
            $message = $e->getMessage();
        }

        return redirect()->route('imunisasi-wus.sasaran')->with($tag, $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = SasaranImunisasiWus::find($id);
        try{
            $data->delete();
            $tag = 'success';
            $message = 'Berhasil menghapus data!';
        }catch(Exception $e){
            $tag = 'error';
            $message = $e->getMessage();
        }

        return redirect()->route('imunisasi-wus.sasaran')->with($tag, $message);
    }
}
