<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            WilayahKerjaSeeders::class,
            UserSeeders::class,
            KegiatanPromosiKesehatanUmumSeeders::class,
            ProgramDivisiPromkesSeeder::class,
            KegiatanProgramPromkesSeeder::class,
            PencatatanKegiatanProgramPromkesSeeder::class,
            ProgramKiaGiziSeeder::class,
            KegiatanProgramKiaGiziSeeder::class,
            PencatatanKegiatanProgramKiaGiziSeeder::class,
            KegiatanProgramKesehatanSekolahSeeder::class,
            KelasSiswaSeeder::class,

        ]);
    }
}
