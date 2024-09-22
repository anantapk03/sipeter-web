<?php

namespace Database\Seeders;

use App\Models\PencatatanKegiatanProgramKiaGizi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PencatatanKegiatanProgramKiaGiziSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PencatatanKegiatanProgramKiaGizi::create([
            'idKegiatanProgramKiaGizi' => 1,  // Pastikan ID ini sudah ada di tabel kegiatan_program_kia_gizis
            'idDesa' => 1,  // Pastikan ID ini sudah ada di tabel wilayah_kerja
            'bulan' => '1',
            'tahun' => 2024,
            'jumlah' => 100,
            'deskripsi' => 'Pencatatan kegiatan bulan Januari.',
        ]);

        PencatatanKegiatanProgramKiaGizi::create([
            'idKegiatanProgramKiaGizi' => 1,
            'idDesa' => 2,
            'bulan' => '2',
            'tahun' => 2024,
            'jumlah' => 120,
            'deskripsi' => 'Pencatatan kegiatan bulan Februari.',
        ]);
    }
}
