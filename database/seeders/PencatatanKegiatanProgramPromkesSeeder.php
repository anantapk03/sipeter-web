<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class PencatatanKegiatanProgramPromkesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pencatatan_kegiatan_program_promkes')->insert([
            [
                'idKegiatanProgramPromkes' => 1, // Sesuaikan dengan idKegiatanProgramPromkes yang ada di tabel kegiatan_program_promkes
                'jumlah' => 50,
                'deskripsi' => 'Deskripsi pencatatan kegiatan 1 program 1',
                'bulan'=>'8',
                'tahun'=>2024
            ],
            [
                'idKegiatanProgramPromkes' => 1, // Sesuaikan dengan idKegiatanProgramPromkes yang ada di tabel kegiatan_program_promkes
                'jumlah' => 100,
                'deskripsi' => 'Deskripsi pencatatan kegiatan 2 program 1',
                'bulan'=>'7',
                'tahun'=>2024
            ],
            [
                'idKegiatanProgramPromkes' => 2, // Sesuaikan dengan idKegiatanProgramPromkes yang ada di tabel kegiatan_program_promkes
                'jumlah' => 150,
                'deskripsi' => 'Deskripsi pencatatan kegiatan 1 program 2',
                'bulan'=>'8',
                'tahun'=>2024
            ],
        ]);
    }
}
