<?php

namespace Database\Seeders;

use App\Models\JenisImunisasiBaduta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisImunisasiBadutaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisImunisasiBaduta::create([
            'namaImunisasi' => 'Imunisasi Polio',
            'deskripsi' => 'Imunisasi untuk mencegah penyakit polio.',
            'isActive' => true,
        ]);

        JenisImunisasiBaduta::create([
            'namaImunisasi' => 'Imunisasi BCG',
            'deskripsi' => 'Imunisasi untuk mencegah tuberkulosis (TBC).',
            'isActive' => true,
        ]);
    }
}
