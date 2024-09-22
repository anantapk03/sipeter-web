<?php

namespace Database\Seeders;

use App\Models\KegiatanProgramKesehatanSekolah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KegiatanProgramKesehatanSekolahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KegiatanProgramKesehatanSekolah::create([
            'namaKegiatan' => 'Pemeriksaan Kesehatan Gigi',
            'deskripsi' => 'Pemeriksaan rutin kesehatan gigi bagi siswa sekolah dasar.',
            'targetBulanan' => 100,
            'targetTriwulan' => 300,
            'targetSemester' => 600,
            'targetTahunan' => 1200,
            'isActive' => true,
        ]);

        KegiatanProgramKesehatanSekolah::create([
            'namaKegiatan' => 'Vaksinasi di Sekolah',
            'deskripsi' => 'Program vaksinasi tahunan untuk siswa sekolah menengah.',
            'targetBulanan' => 50,
            'targetTriwulan' => 150,
            'targetSemester' => 300,
            'targetTahunan' => 600,
            'isActive' => true,
        ]);
    }
}
