<?php

namespace Database\Seeders;

use App\Models\ProgramKiaGizi;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramKiaGiziSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProgramKiaGizi::create([
            'namaProgram' => 'Program Gizi Ibu dan Anak',
            'deskripsi' => 'Program untuk meningkatkan gizi ibu dan anak.',
            'isActive' => true,
        ]);

        ProgramKiaGizi::create([
            'namaProgram' => 'Program Gizi Lansia',
            'deskripsi' => 'Program untuk meningkatkan gizi lansia.',
            'isActive' => true,
        ]);
    }
}
