<?php

namespace App\helpers;
use App\Models\Desa;
use App\Models\JenisImunisasiBaduta;
use App\Models\JenisImunisasiBayi;
use App\Models\KegiatanProgramPengendalianPenyakit;
use App\Models\KelasSiswa;
use App\Models\LaporanImunisasiBaduta;
use App\Models\LaporanImunisasiBayi;
use App\Models\PencatatanKegiatanProgramKesehatanSekolah;
use App\Models\PencatatanKegiatanProgramKiaGizi;
use App\Models\PencatatanProgramPengendalianPenyakit;
use Carbon\Carbon;
use Exception;
// use App\Http\Controllers\ukm_promkes\PencatatanKegiatanProgramPromkesController;
// use App\Models\PencatatanKegiatanProgramPromkes;

class MonthHelper
{
    public static function getMonth(int $monthNumber){
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

    public static function logicGetMonth(){
        $currentMonth = Carbon::now()->month;
        $currentDay = date('j');

        if($currentDay < 5){
            $currentMonth = $currentMonth - 1;
        }
        return $currentMonth;
    }

    public static function checkYear(){
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

    public static function checkDesaInReport($IdKegiatan){
        $currentMonth = self::logicGetMonth(); 
        // $currentMonth = (int) $currentMonth;
        $currentYear = self::checkYear();

        $dataInThisMonthAndYear = PencatatanKegiatanProgramKiaGizi::where('bulan', $currentMonth)
        ->where('tahun', $currentYear)->where('idKegiatanProgramKiaGizi', $IdKegiatan)->pluck('idDesa');
        $desa = Desa::whereNotIn('id', $dataInThisMonthAndYear)->get();
        // dd ($desa);

        return $desa;
    }

    public static function checkClassInReport($id){
        $currentMonth = self::logicGetMonth();
        $currentYear = self::checkYear();

        $dataThisMonthAndYear = PencatatanKegiatanProgramKesehatanSekolah::where('bulan', $currentMonth)->where('tahun', $currentYear)
        ->where('idKegiatanProgramKesehatanSekolah', $id)->pluck('idKelasSiswa');
        $kelas = KelasSiswa::whereNotIn('id', $dataThisMonthAndYear)->get();

        return $kelas;
    }

    public static function checkJenisImunisasiInReport($id){
        $dataReportInThisMonthAndYear = LaporanImunisasiBayi::where('idSasaran', $id)->pluck('idJenisImunisasi');
        $jenisImunisasi = JenisImunisasiBayi::where('isActive', true)->whereNotIn('id', $dataReportInThisMonthAndYear)->get();
        return $jenisImunisasi;
    }

    public static function checkJenisImunisasiBadutaInReport($id){
        $dataReportInThisMonthAndYear = LaporanImunisasiBaduta::where('idSasaranImunisasi', $id)->pluck('idJenisImunisasi');
        $jenisImunisasi = JenisImunisasiBaduta::whereNotIn('id', $dataReportInThisMonthAndYear)->get();
        return $jenisImunisasi;
    }

    public static function checkReportP2InThisMonth($idProgram){
        $currentMonth = self::logicGetMonth();
        $year = self::checkYear();
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
}
