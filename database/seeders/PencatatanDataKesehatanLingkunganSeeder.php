<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PencatatanDataKesehatanLingkunganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pencatatan_data_kesling')->insert([
            'idKegiatanKesling' => 6,
            'jumlah' => 2,
            'deskripsi' => "telah dilakukan pemantauan sarana air minum dengan hasil tertera",
            'bulan' => 9,
            'tahun' => 2024
        ]);
        DB::table('pencatatan_data_kesling')->insert([
            'idKegiatanKesling' => 7,
            'jumlah' => 1,
            'deskripsi' => "telah dilakukan pemantauan sarana air minum dengan hasil tertera",
            'bulan' => 9,
            'tahun' => 2024
        ]);
        DB::table('pencatatan_data_kesling')->insert([
            'idKegiatanKesling' => 8,
            'jumlah' => 4,
            'deskripsi' => "telah dilakukan pemantauan sarana air minum dengan hasil tertera",
            'bulan' => 9,
            'tahun' => 2024
        ]);
        DB::table('pencatatan_data_kesling')->insert([
            'idKegiatanKesling' => 9,
            'jumlah' => 0,
            'deskripsi' => "telah dilakukan pemantauan sarana air minum dengan hasil tertera",
            'bulan' => 9,
            'tahun' => 2024
        ]);
    }
}
