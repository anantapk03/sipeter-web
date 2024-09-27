<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DataKesehatanLingkunganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kegiatan_kesling')->insert([
            'kegiatan' => "jumlah sarana air minum yang memiliki resiko tingkat rendah",
            'deskripsi' => "Pemantauan jumlah saran air minum",
            'bulanan' => 4,
            'triwulan' => 12,
            'semester' => 26,
            'tahunan' => 32,
            'status' => "active"
        ]);
        DB::table('kegiatan_kesling')->insert([
            'kegiatan' => "jumlah sarana air minum yang memiliki resiko tingkat sedang",
            'deskripsi' => "Pemantauan jumlah saran air minum",
            'bulanan' => 4,
            'triwulan' => 12,
            'semester' => 26,
            'tahunan' => 32,
            'status' => "active"
        ]);
        DB::table('kegiatan_kesling')->insert([
            'kegiatan' => "jumlah sarana air minum yang memiliki resiko tingkat tinggi",
            'deskripsi' => "Pemantauan jumlah saran air minum",
            'bulanan' => 4,
            'triwulan' => 12,
            'semester' => 26,
            'tahunan' => 32,
            'status' => "active"
        ]);
        DB::table('kegiatan_kesling')->insert([
            'kegiatan' => "jumlah sarana air minum yang memiliki resiko tingkat amat tinggi",
            'deskripsi' => "Pemantauan jumlah saran air minum",
            'bulanan' => 4,
            'triwulan' => 12,
            'semester' => 26,
            'tahunan' => 32,
            'status' => "active"
        ]);
        DB::table('kegiatan_kesling')->insert([
            'kegiatan' => "jumlah sarana air minum yang memiliki resiko tingkat rendah",
            'deskripsi' => "Pemantauan jumlah saran air minum",
            'bulanan' => 4,
            'triwulan' => 12,
            'semester' => 26,
            'tahunan' => 32,
            'status' => "active"
        ]);
    }
}
