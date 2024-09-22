<?php

namespace Database\Seeders;

use App\Models\PencatatanKegiatanProgramKesehatanSekolah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PencatatanKegiatanProgramKesehatanSekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PencatatanKegiatanProgramKesehatanSekolah::create([
            'idKegiatanProgramKesehatanSekolah' => 1,
            'idKelasSiswa' => 1,
            'bulan' => '1',
            'tahun' => 2024,
            'jumlah' => 30,
            'deskripsi' => 'Deskripsi kegiatan kesehatan sekolah untuk bulan Januari.',
        ]);

        PencatatanKegiatanProgramKesehatanSekolah::create([
            'idKegiatanProgramKesehatanSekolah' => 2,
            'idKelasSiswa' => 2,
            'bulan' => '2',
            'tahun' => 2024,
            'jumlah' => 25,
            'deskripsi' => 'Deskripsi kegiatan kesehatan sekolah untuk bulan Februari.',
        ]);
    }
}
