<?php

namespace Database\Seeders;

use App\Models\Divisi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisi = [
            [
                'id' => 1,
                'namaDivisi' => 'promosi-kesehatan',
                'deskripsi' => 'Divisi yang bertugas untuk mempromosikan kesehatan masyarakat.',
                'isActive' => true,
            ],
            [
                'id' => 2,
                'namaDivisi' => 'kesehatan-lingkungan',
                'deskripsi' => 'Divisi yang fokus pada kesehatan lingkungan seperti sanitasi dan air bersih.',
                'isActive' => true,
            ],
            [
                'id' => 3,
                'namaDivisi' => 'kesehatan-ibu-anak-gizi',
                'deskripsi' => 'Divisi yang menangani kesehatan ibu, anak, dan gizi masyarakat.',
                'isActive' => true,
            ],
            [
                'id' => 4,
                'namaDivisi' => 'pencegahan-dan-pengendalian-penyakit',
                'deskripsi' => 'Divisi yang bertugas mencegah dan mengendalikan penyakit menular.',
                'isActive' => true,
            ],
            [
                'id' => 5,
                'namaDivisi' => 'admin',
                'deskripsi' => 'Divisi administratif untuk mendukung operasional seluruh program.',
                'isActive' => true,
            ],
        ];

        foreach ($divisi as $data) {
            Divisi::create($data);
        }
    }
}
