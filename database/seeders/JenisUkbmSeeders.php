<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisUkbmSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_ukbm')->create([
            'jenisUkbm' => 'Pos Obat Desa',
            'bulan' => 4,
            'triwulan' => 12,
            'semester' => 24,
            'tahunan' => 48
        ]);
    }
}
