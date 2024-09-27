<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DataUkbmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('data_ukbm')->insert([
            'idDesa' => 1,
            'idJenisUkbm' => 1,
            'namaUkbm' => "Posyandu untuk balita",
            'alamatUkbm' => "Indramayu",
            'sumberPembiayaan' => "Dana Desa",
            'kegiatanUkbm' => "Suntik Polio untuk balita",
            'jumlahKader' => 5,
            'jumlahKaderDilatih' => 10,
            'status' => "active"
        ]);

        DB::table('data_ukbm')->insert([
            'idDesa' => 2,
            'idJenisUkbm' => 2,
            'namaUkbm' => "Pos Gizi untuk balita",
            'alamatUkbm' => "Indramayu",
            'sumberPembiayaan' => "Dana Desa",
            'kegiatanUkbm' => "Pemberian asupan gizi pada balita",
            'jumlahKader' => 5,
            'jumlahKaderDilatih' => 10,
            'status' => "active"
        ]);
    }
}
