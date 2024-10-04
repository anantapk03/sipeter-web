<?php

namespace App\Http\Controllers;

use App\Models\JenisImunisasiWus;
use App\Models\LaporanImunisasiWus;
use App\Models\SasaranImunisasiWus;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PencatatanWusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $idSasaran)
    {
        $data = DB::table('laporan_imunisasi_wus')
            ->leftJoin('jenis_imunisasi_wus', 'laporan_imunisasi_wus.idJenis', '=', 'jenis_imunisasi_wus.id')
            ->leftJoin('sasaran_imunisasi_wus', 'laporan_imunisasi_wus.idSasaran', '=', 'sasaran_imunisasi_wus.id')
            ->leftJoin('wilayah_kerja', 'sasaran_imunisasi_wus.idDesa', '=', 'wilayah_kerja.id')
            ->select('laporan_imunisasi_wus.id as idLaporan', 'laporan_imunisasi_wus.*', 'sasaran_imunisasi_wus.*', 'jenis_imunisasi_wus.*', 'wilayah_kerja.namaDesa')
            ->where('sasaran_imunisasi_wus.id', $idSasaran)
            ->get();

        
        // Step 2: Get the total count of all available 'jenis_imunisasi_wus'
        $totalJenis = JenisImunisasiWus::count(); // Count of all possible 'jenis imunisasi'

        // Step 3: Get the count of 'jenis imunisasi' that are already linked to this 'sasaran'
        $linkedJenisCount = DB::table('laporan_imunisasi_wus')
            ->where('idSasaran', $idSasaran)
            ->count(); // Count of 'jenis imunisasi' already added for the given 'sasaran'

        $sasaran = SasaranImunisasiWus::find($idSasaran);
        // $data = LaporanImunisasiWus::where('idSasaran', $id)->get();

        // dd($data);
        #dd($sasaran);
        return view('admin.ukm-essensial.pengendalian-penyakit.imunisasi.imunisasi-wus.laporan-imunisasi.index', ['data' => $data, 'sasaran' => $sasaran, 'totalJenis' => $totalJenis, 'linkedJenis' => $linkedJenisCount]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        
        

        // Step 1: Retrieve the specific 'sasaran' data
        $sasaran = SasaranImunisasiWus::leftJoin('wilayah_kerja', 'sasaran_imunisasi_wus.idDesa', '=', 'wilayah_kerja.id')
            ->select('sasaran_imunisasi_wus.id', 'wilayah_kerja.namaDesa', 'sasaran_imunisasi_wus.*')
            ->where('sasaran_imunisasi_wus.id', $id)
            ->first();

        // Step 2: Get IDs of 'jenis imunisasi' already added for this specific 'sasaran' (linked through 'LaporanImunisasiWus')
        $addedData = LaporanImunisasiWus::where('idSasaran', $sasaran->id)  // Assuming 'idSasaran' is the foreign key in 'LaporanImunisasiWus'
                    ->pluck('idJenis');

        // Step 3: Retrieve 'jenis imunisasi' data excluding the ones already added for this 'sasaran'
        $jenis = JenisImunisasiWus::whereNotIn('id', $addedData)->get();


        #dd($jenis);

        return view('admin.ukm-essensial.pengendalian-penyakit.imunisasi.imunisasi-wus.laporan-imunisasi.create', ['sasaran' => $sasaran, 'jenis' => $jenis]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(string $idSasaran ,Request $request)
    {
        LaporanImunisasiWus::create([
            'idSasaran' => $idSasaran,
            'idJenis' => $request->jenis,
            'jumlah' => $request->jumlah
        ]);

        try{
            $tag = 'success';
            $msg = 'berhasil tambah data!';
        }catch(Exception $e){
            $tag = 'error';
            $msg = $e->getMessage();
        }
        #dd($data);
        return redirect()->route('imunisasi-wus.laporan.index', $idSasaran)->with($tag, $msg);
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
    public function edit(string $idSasaran, string $id)
    {
        $sasaran = SasaranImunisasiWus::leftJoin('wilayah_kerja', 'sasaran_imunisasi_wus.idDesa', '=', 'wilayah_kerja.id')
            ->select('sasaran_imunisasi_wus.id as idSasaran', 'wilayah_kerja.namaDesa', 'sasaran_imunisasi_wus.*')
            ->where('sasaran_imunisasi_wus.id', $idSasaran)
            ->first();

        $jenis = JenisImunisasiWus::all();
        $data = LaporanImunisasiWus::findOrFail($id);
        #dd($sasaran);

        return view('admin.ukm-essensial.pengendalian-penyakit.imunisasi.imunisasi-wus.laporan-imunisasi.edit', compact('sasaran', 'data', 'jenis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $idSasaran, string $id)
    {
        $data = LaporanImunisasiWus::find($id);
        $data->idJenis = $request->jenis;
        $data->jumlah = $request->jumlah;

        try{
            $data->update();
            $tag = 'success';
            $msg = 'berhasil ubah data!';
        }catch(Exception $e){
            $tag = 'error';
            $msg = $e->getMessage();
        }

        return redirect()->route('imunisasi-wus.laporan.index', $idSasaran)->with($tag, $msg);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $idSasaran, string $id)
    {
        $data = LaporanImunisasiWus::find($id);

        try{
            $data->delete();
            $tag = 'success';
            $msg = 'berhasil hapus data!';
        }catch(Exception $e){
            $tag = 'error';
            $msg = $e->getMessage();
        }
        #dd($data);
        return redirect()->route('imunisasi-wus.laporan.index', $idSasaran)->with($tag, $msg);
    }
}
