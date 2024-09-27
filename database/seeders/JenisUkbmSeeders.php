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
        DB::table('jenis_ukbm')->insert([
            'jenisUkbm' => 'Pos Obat Desa',
            'bulanan' => 4,
            'triwulan' => 12,
            'semester' => 24,
            'tahunan' => 48
        ]);
        DB::table('jenis_ukbm')->insert([
            'jenisUkbm' => 'Posyandu Balita',
            'bulanan' => 4,
            'triwulan' => 12,
            'semester' => 24,
            'tahunan' => 48
        ]);
        DB::table('jenis_ukbm')->insert([
            'jenisUkbm' => 'Pos gizi',
            'bulanan' => 2,
            'triwulan' => 4,
            'semester' => 8,
            'tahunan' => 16
        ]);
        DB::table('jenis_ukbm')->insert([
            'jenisUkbm' => 'Poliklinik Kesehatan Desa',
            'bulanan' => 1,
            'triwulan' => 3,
            'semester' => 6,
            'tahunan' => 12
        ]);
    }
}
