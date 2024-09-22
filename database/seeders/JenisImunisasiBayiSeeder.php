<?php

namespace Database\Seeders;

use App\Models\JenisImunisasiBayi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisImunisasiBayiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisImunisasiBayi::create([
            'namaImunisasi' => 'BCG',
            'deskripsi' => 'Imunisasi BCG untuk mencegah tuberkulosis.',
            'isActive' => true,
        ]);

        JenisImunisasiBayi::create([
            'namaImunisasi' => 'Polio',
            'deskripsi' => 'Imunisasi Polio untuk mencegah poliomielitis.',
            'isActive' => true,
        ]);
    }
}
