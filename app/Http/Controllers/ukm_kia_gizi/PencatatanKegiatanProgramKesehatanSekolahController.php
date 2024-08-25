<?php

namespace App\Http\Controllers\ukm_kia_gizi;

use App\Http\Controllers\Controller;
use App\Models\KegiatanProgramKesehatanSekolah;
use App\Models\KelasSiswa;
use App\Models\PencatatanKegiatanProgramKesehatanSekolah;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PencatatanKegiatanProgramKesehatanSekolahController extends Controller
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

    public function checkClassInReport($id){
        $currentMonth = $this->logicGetMonth();
        $currentYear = $this->checkYear();

        $dataThisMonthAndYear = PencatatanKegiatanProgramKesehatanSekolah::where('bulan', $currentMonth)->where('tahun', $currentYear)
        ->where('idKegiatanProgramKesehatanSekolah', $id)->pluck('idKelasSiswa');
        $kelas = KelasSiswa::whereNotIn('id', $dataThisMonthAndYear)->get();

        return $kelas;
    }



    
    public function index($id){
        try{
            $dataKegiatan = KegiatanProgramKesehatanSekolah::find($id);
        } catch(Exception $e){
            return redirect()->back()->with('error','Data tidak ditemukan');
        }
        $currentMonth = $this->logicGetMonth();
        $currentYear = $this->checkYear();
        $monthName = $this->getMonth($currentMonth);
        $kelasSiswa = $this->checkClassInReport($id);
        $data = PencatatanKegiatanProgramKesehatanSekolah::where('idKegiatanProgramKesehatanSekolah', $id)
        ->where('bulan', $currentMonth)
        ->where('tahun', $currentYear)->get();

        return view('admin.ukm-essensial.kia-gizi.kesehatan_sekolah.pencatatan.index', ['dataKegiatan' => $dataKegiatan, 'month'=>$monthName, 'data' => $data, 'kelasSiswa'=>$kelasSiswa]);

    }

    public function create($id){
        $dataKelas = $this->checkClassInReport($id);
        $currentMonth = $this->logicGetMonth();
        $currentYear = $this->checkYear();
        $monthName = $this->getMonth($currentMonth);
        $dataKegiatan = KegiatanProgramKesehatanSekolah::find($id);

        return view('admin.ukm-essensial.kia-gizi.kesehatan_sekolah.pencatatan.create', ['dataKegiatan' => $dataKegiatan, 'monthName' => $monthName, 'dataKelasSiswa' => $dataKelas]);
    }

    public function store($id, Request $request){
        $currentMonth = $this->logicGetMonth();
        $currentYear = $this->checkYear();
        $data = new PencatatanKegiatanProgramKesehatanSekolah();

        $data->bulan = $currentMonth;
        $data->tahun = $currentYear;
        $data->deskripsi = $request->deskripsi;
        $data->idKelasSiswa = $request->idKelasSiswa;
        $data->jumlah = $request->jumlah;
        $data->idKegiatanProgramKesehatanSekolah = $id;

        try{
            $data->save();
            $tag = 'success';
            $message = 'Data berhasil ditambahkan';
        } catch(Exception $e) {
            $tag = 'error';
            $message = 'Data gagal ditambahkan';
        }

        return redirect()->route('kegiatan-program-kia-gizi-pencatatan-UKS-index', ['id'=>$id])->with($tag, $message);
    }

    public function edit($id, $idPencatatan){

        $currentMonth = $this->logicGetMonth();
        $currentYear = $this->checkYear();

        try {
            $data =  PencatatanKegiatanProgramKesehatanSekolah::findOrFail($idPencatatan);

            if($data->bulan != $currentMonth || $data->tahun != $currentYear){
                return redirect()->back()->with('error', 'Akses edit telah ditutup');
            }

            $dataKelas = $this->checkClassInReport($id);
            $currentMonth = $this->logicGetMonth();
            $monthName = $this->getMonth($currentMonth);
            $dataKegiatan = KegiatanProgramKesehatanSekolah::find($id);

            return view('admin.ukm-essensial.kia-gizi.kesehatan_sekolah.pencatatan.update', ['dataKegiatan' => $dataKegiatan, 'monthName' => $monthName, 'dataKelasSiswa' => $dataKelas, 'data'=>$data]);
        
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function update($id, $idPencatatan, Request $request){

        try{
            $data =  PencatatanKegiatanProgramKesehatanSekolah::findOrFail($idPencatatan);
            $currentMonth = $this->logicGetMonth();
            $currentYear = $this->checkYear();
            if($data->bulan != $currentMonth || $data->tahun != $currentYear){
                return redirect()->back()->with('error', 'Akses edit telah ditutup');
            }

            $data->deskripsi = $request->deskripsi;
            $data->jumlah = $request->jumlah;
            $data->idKegiatanProgramKesehatanSekolah = $id;

            try{
                $data->update();
                $tag = 'success';
                $message = 'Data berhasil diperbarui';
            } catch(Exception $e) {
                $tag = 'error';
                $message = $e->getMessage();
            }

        } catch(Exception $e){
            $tag = 'error';
            $message = $e->getMessage();
        }

        return redirect()->route('kegiatan-program-kia-gizi-pencatatan-UKS-index', ['id'=>$id])->with($tag, $message);
    }

    public function delete($id, $idPencatatan){

        try {
            $data = PencatatanKegiatanProgramKesehatanSekolah::findOrFail($idPencatatan);
        } catch(ModelNotFoundException $e){
            $tag = 'error';
            $message = $e->getMessage();
            return redirect()->back()->with($tag, $message);
        }

        $currentMonth = $this->logicGetMonth();
        $currentYear = $this->checkYear();
        if($data->bulan != $currentMonth || $data->tahun != $currentYear){
            return redirect()->back()->with('error', 'Akses edit telah ditutup');
        }

        try{
            $data->delete();
            $tag = 'success';
            $message = 'Data berhasil dihapus';
        } catch(Exception $e){
            $tag = 'error';
            $message = $e->getMessage();
        }

        return redirect()->back()->with($tag, $message);

    }

    public function archieves($id){
        $data = PencatatanKegiatanProgramKesehatanSekolah::where('idKegiatanProgramKesehatanSekolah', $id)->get();
        $dataKegiatan = KegiatanProgramKesehatanSekolah::find($id);
        return view('admin.ukm-essensial.kia-gizi.kesehatan_sekolah.pencatatan.archieve', ['data' => $data, 'dataKegiatan' => $dataKegiatan]);
    }


}
