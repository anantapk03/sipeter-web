<?php

namespace Database\Seeders;

use App\Models\PencatatanProgramPengendalianPenyakit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PencatatanProgramPengendalianPenyakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PencatatanProgramPengendalianPenyakit::create([
            'idKegiatan' => 1,
            'jumlah' => 50,
            'bulan' => '9',
            'tahun' => 2024,
            'deskripsi' =>"Ini Deskripsi",
        ]);
    }
}
