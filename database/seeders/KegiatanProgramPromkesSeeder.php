<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class KegiatanProgramPromkesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kegiatan_program_promkes')->insert([
            [
                'idProgram' => 1, // Sesuaikan dengan idProgram yang ada di tabel program_divisi_promkes
                'namaKegiatan' => 'Kegiatan 1 Program 1',
                'deskripsi' => 'Deskripsi kegiatan 1 program 1',
                'targetBulanan' => 10,
                'targetTriwulan' => 30,
                'targetSemester' => 60,
                'targetTahunan' => 120,
                'isActive' => true,
            ],
            [
                'idProgram' => 1, // Sesuaikan dengan idProgram yang ada di tabel program_divisi_promkes
                'namaKegiatan' => 'Kegiatan 2 Program 1',
                'deskripsi' => 'Deskripsi kegiatan 2 program 1',
                'targetBulanan' => 15,
                'targetTriwulan' => 45,
                'targetSemester' => 90,
                'targetTahunan' => 180,
                'isActive' => true,
            ],
            [
                'idProgram' => 3, // Sesuaikan dengan idProgram yang ada di tabel program_divisi_promkes
                'namaKegiatan' => 'Kegiatan 1 Program 2',
                'deskripsi' => 'Deskripsi kegiatan 1 program 2',
                'targetBulanan' => 20,
                'targetTriwulan' => 60,
                'targetSemester' => 120,
                'targetTahunan' => 240,
                'isActive' => false,
            ],
        ]);
    }
}
