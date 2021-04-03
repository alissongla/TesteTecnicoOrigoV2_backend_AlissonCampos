<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('@Admin123'),
                'created_at' => date('Y-d-m h:i:s'),
            ],
            [
                'name' => 'user1',
                'email' => 'user1@gmail.com',
                'password' => Hash::make('@User123'),
                'created_at' => date('Y-d-m h:i:s'),
            ],
        ];
        DB::table('users')->insert($users);
    }
}
