<?php

namespace Database\Seeders;

use App\Models\KegiatanProgramPengendalianPenyakit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KegiatanProgramPengendalianPenyakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KegiatanProgramPengendalianPenyakit::create([
            'idProgram' => 1,
            'namaKegiatan' => 'Kegiatan Contoh',
            'targetJumlah' => 100,
            'deskripsi' => 'Deskripsi untuk kegiatan contoh.',
            'isActive' => true,
        ]);
    }
}
