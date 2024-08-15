<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class KegiatanPromosiKesehatanUmumSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kegiatan_promosi_kesehatan_umum_desa')->insert([
            [
                'namaKegiatan' => 'Penyuluhan Gizi Seimbang',
                'deskripsiKegiatan' => 'Kegiatan penyuluhan mengenai pentingnya gizi seimbang bagi kesehatan tubuh.',
                'targetBulanan' => 50,
                'targetTriwulan' => 150,
                'targetSemester' => 300,
                'targetTahunan' => 600,
                'isActive' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'namaKegiatan' => 'Pemeriksaan Kesehatan Gratis',
                'deskripsiKegiatan' => 'Kegiatan pemeriksaan kesehatan gratis untuk masyarakat desa.',
                'targetBulanan' => 100,
                'targetTriwulan' => 300,
                'targetSemester' => 600,
                'targetTahunan' => 1200,
                'isActive' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'namaKegiatan' => 'Senam Sehat',
                'deskripsiKegiatan' => 'Kegiatan senam bersama untuk meningkatkan kebugaran masyarakat desa.',
                'targetBulanan' => 30,
                'targetTriwulan' => 90,
                'targetSemester' => 180,
                'targetTahunan' => 360,
                'isActive' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan data lain sesuai kebutuhan
        ]);
    }
}
