<?php

namespace Database\Seeders;

use App\Models\SasaranImunisasiBaduta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SasaranImunisasiBadutaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SasaranImunisasiBaduta::create([
            'idDesa' => 1,  // Ganti dengan idDesa yang sesuai
            'sasaran_laki' => 50,
            'sasaran_perempuan' => 50,
            'deskripsi' => 'Sasaran imunisasi untuk Baduta di desa A',
            'tahun' => 2024,
            'bulan'=>'9'
            
        ]);
    }
}
