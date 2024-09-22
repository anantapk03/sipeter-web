<?php

namespace Database\Seeders;

use App\Models\LaporanImunisasiBaduta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LaporanImunisasiBadutaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LaporanImunisasiBaduta::create([
            'idSasaranImunisasi' => 2,  // Ganti dengan id yang sesuai
            'idJenisImunisasi' => 1,    // Ganti dengan id yang sesuai
            'jumlah_laki' => 10,
            'jumlah_perempuan' => 12,
            'deskripsi' => 'Laporan imunisasi untuk baduta di desa A',
        ]);
    }
}
