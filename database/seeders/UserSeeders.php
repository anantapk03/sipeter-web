<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class UserSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'nama' => "Fathur",
            'username' => "AdminFathur",
            'nip' => '001122334455667788',
            'password' => bcrypt('developers'),
            'level'=> "admin",
            'imageUrl'=> "profile.png",
            'status'=>'active'
        ]);
    }
}
