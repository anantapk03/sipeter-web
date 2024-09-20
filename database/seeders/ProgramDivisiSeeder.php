<?php

namespace Database\Seeders;

use App\Models\ProgramDivisi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramDivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programDivisi = [
            ['idDivisi' => 1, 'namaProgram' => 'kesehatan-umum-desa', 'isActive' => true],
            ['idDivisi' => 1, 'namaProgram' => 'another-program-promkes', 'isActive' => true],
            ['idDivisi' => 3, 'namaProgram' => 'program Usaha Kesehatan Sekolah', 'isActive' => true],
            ['idDivisi' => 3, 'namaProgram' => 'another-program-kia-gizi', 'isActive' => true],
            ['idDivisi' => 4, 'namaProgram' => 'imunisasi', 'isActive' => true],
            ['idDivisi' => 4, 'namaProgram' => 'another-program-pengendalian-penyakit', 'isActive' => true],
            ['idDivisi' => 2, 'namaProgram' => 'all-kesehatan-lingkungan', 'isActive' => true],
            ['idDivisi' => 5, 'namaProgram' => 'admin-access', 'isActive' => true],
        ];

        foreach ($programDivisi as $program) {
            ProgramDivisi::create($program);
        }
    }
}
