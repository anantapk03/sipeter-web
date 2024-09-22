<?php

namespace Database\Seeders;

use App\Models\ProgramPengendalianPenyakit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramPengendalianPenyakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProgramPengendalianPenyakit::create([
            'idCategory' => 1, // Menular
            'namaProgram' => 'Pengendalian Penyakit Menular',
            'deskripsi' => 'Program untuk mengendalikan penyakit menular.',
            'isActive' => true,
        ]);

        ProgramPengendalianPenyakit::create([
            'idCategory' => 2, // Tidak Menular
            'namaProgram' => 'Pengendalian Penyakit Tidak Menular',
            'deskripsi' => 'Program untuk mengendalikan penyakit tidak menular.',
            'isActive' => true,
        ]);
    }
}
