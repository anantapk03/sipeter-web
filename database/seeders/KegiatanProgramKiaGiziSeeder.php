<?php

namespace Database\Seeders;

use App\Models\KegiatanProgramKiaGizi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KegiatanProgramKiaGiziSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KegiatanProgramKiaGizi::create([
            'idProgramKiaGizi' => 1,  // Pastikan ID ini sudah ada di tabel program_kia_gizis
            'namaKegiatan' => 'Kegiatan Gizi Ibu Hamil',
            'deskripsi' => 'Kegiatan untuk meningkatkan gizi ibu hamil di setiap desa.',
            'targetJumlahSetiapDesa' => 10,
            'targetJumlahDesaMelaksanakan' => 8,
            'targetBulanan' => 30,
            'targetTriwulan' => 90,
            'targetSemester' => 180,
            'targetTahunan' => 360,
            'isActive' => true,
        ]);
    }
}
