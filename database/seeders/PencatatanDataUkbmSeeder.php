<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PencatatanDataUkbmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pencatatan_data_ukbm')->insert([
            'idDataUkbm'=>1,
            'bulan' => 9,
            'tahun' => 2024,
            'deskripsi' => "telah dilakukan kegiatan tersebut dengan banyak peserta sebanyak 20 orang"
        ]);
        
        DB::table('pencatatan_data_ukbm')->insert([
            'idDataUkbm'=>2,
            'bulan' => 9,
            'tahun' => 2024,
            'deskripsi' => "telah dilakukan kegiatan tersebut dengan banyak peserta sebanyak 20 orang"
        ]);

        DB::table('pencatatan_data_ukbm')->insert([
            'idDataUkbm'=>3,
            'bulan' => 9,
            'tahun' => 2024,
            'deskripsi' => "telah dilakukan kegiatan tersebut dengan banyak peserta sebanyak 20 orang"
        ]);
    }
}
