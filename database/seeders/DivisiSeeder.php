<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisi = [
            ['id' => 1, 'namaDivisi' => 'promosi-kesehatan', 'isActive' => true],
            ['id' => 2, 'namaDivisi' => 'kesehatan-lingkungan', 'isActive' => true],
            ['id' => 3, 'namaDivisi' => 'kesehatan-ibu-anak-gizi', 'isActive' => true],
            ['id' => 4, 'namaDivisi' => 'pencegahan-dan-pengendalian-penyakit', 'isActive' => true],
            ['id' => 5, 'namaDivisi' => 'admin', 'isActive' => true],
        ];

        DB::table('divisi')->insert($divisi);
    }
}
