<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'user',
                'email' => 'user@gmail.com',
                'password' => bcrypt('user'),
                'telepone' => '0812-3456-7890',
                'gender' => 'Male',
                'alamat' => 'Jawa Timur',
                'role' => 'user'
            ],
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin'),
                'telepone' => '0123-4567-8901',
                'gender' => 'Male',
                'alamat' => 'Surabaya',
                'role' => 'admin'
            ]
        ]);
    }
}
