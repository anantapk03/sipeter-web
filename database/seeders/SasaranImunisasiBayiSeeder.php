<?php

namespace Database\Seeders;

use App\Models\SasaranImunisasiBayi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SasaranImunisasiBayiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SasaranImunisasiBayi::create([
            'idDesa' => 1,
            'jumlah_sasaran_bayi_laki' => 100,
            'jumlah_sasaran_bayi_perempuan' => 90,
            'jumlah_surviving_infant_laki' => 95,
            'jumlah_surviving_infant_perempuan' => 85,
            'bulan' => '1',
            'tahun' => 2024,
        ]);
    }
}
