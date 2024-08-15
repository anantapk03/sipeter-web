<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ProgramDivisiPromkesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('program_divisi_promkes')->insert([
            [
                'namaProgram' => 'Program Kesehatan 1',
                'deskripsi' => 'Deskripsi program kesehatan 1',
                'isActive' => true,
            ],
            [
                'namaProgram' => 'Program Kesehatan 2',
                'deskripsi' => 'Deskripsi program kesehatan 2',
                'isActive' => true,
            ],
            [
                'namaProgram' => 'Program Kesehatan 3',
                'deskripsi' => 'Deskripsi program kesehatan 3',
                'isActive' => false,
            ],
        ]);
    }
}
