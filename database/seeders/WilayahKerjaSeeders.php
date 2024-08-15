<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class WilayahKerjaSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('wilayah_kerja')->insert([
            [
                'namaDesa' => 'Desa A',
                'lat' => -7.250445,
                'lon' => 112.768845,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'namaDesa' => 'Desa B',
                'lat' => -6.917464,
                'lon' => 107.619123,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'namaDesa' => 'Desa C',
                'lat' => -7.795580,
                'lon' => 110.369490,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan data lain sesuai kebutuhan
        ]);
    }
}
