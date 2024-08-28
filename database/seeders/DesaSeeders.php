<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DesaSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('wilayah_kerja')->insert([
            'namaDesa' => "Cantigi Kulon",
            'lat' => -36.1,
            'lon' => 27.3
        ]);
    }
}
