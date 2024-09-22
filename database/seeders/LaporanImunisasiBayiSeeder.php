<?php

namespace Database\Seeders;

use App\Models\LaporanImunisasiBayi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LaporanImunisasiBayiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LaporanImunisasiBayi::create([
            'idJenisImunisasi' => 1, // Sesuaikan dengan data di tabel `jenis_imunisasi_bayi`
            'idSasaran' => 1,        // Sesuaikan dengan data di tabel `sasaran_imunisasi_bayi`
            'jumlah_laki' => 50,
            'jumlah_perempuan' => 45,
            'deskripsi'=> "Kegiatan dilakukan pada wilayah RW. A RT 01, 01 03..."
        ]);

        LaporanImunisasiBayi::create([
            'idJenisImunisasi' => 2,
            'idSasaran' => 2,
            'jumlah_laki' => 60,
            'jumlah_perempuan' => 55,
            'deskripsi'=> "Kegiatan dilakukan pada wilayah RW. A RT 01, 01 03..."
        ]);
    }
}
