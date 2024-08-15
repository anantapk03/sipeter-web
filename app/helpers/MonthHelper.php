<?php

namespace App\helpers;
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
}
