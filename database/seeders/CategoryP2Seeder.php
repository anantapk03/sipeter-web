<?php

namespace Database\Seeders;

use App\Models\CategoryP2;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryP2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CategoryP2::create([
            'namaCategory' => 'Menular',
            'deskripsi' => 'Kategori penyakit yang bersifat menular.',
            'isActive' =>true
        ]);

        CategoryP2::create([
            'namaCategory' => 'Tidak Menular',
            'deskripsi' => 'Kategori penyakit yang bersifat tidak menular.',
            'isActive' =>true
        ]);
    }
}
