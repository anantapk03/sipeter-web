<?php

namespace Database\Seeders;

use App\Models\KelasSiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KelasSiswa::create([
            'namaKelas' => 'Kelas 1',
            'deskripsi' => 'Kelas 1 untuk siswa berumur 6-7 tahun',
        ]);

        KelasSiswa::create([
            'namaKelas' => 'Kelas 2',
            'deskripsi' => 'Kelas 2 untuk siswa berumur 7-8 tahun',
        ]);
    }
}
