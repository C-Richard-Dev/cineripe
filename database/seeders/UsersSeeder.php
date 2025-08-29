<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'type' => 'admin',
                'name' => 'admin',
                'email' => 'admin@email.com',
                'password' => '123123',
            ],
            
            [
                'type' => 'user',
                'name' => 'usuario.comum',
                'email' => 'user@email.com',
                'password' => '123123',
            ],
        ]);
    }
}
