<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategoris')->insert([
            [
                'nm_kategori' => 'PC Packages',
            ],
            [
                'nm_kategori' => 'Monitor',
            ],
            [
                'nm_kategori' => 'Accessories',
            ],
            [
                'nm_kategori' => 'Spare Part',
            ]
        ]);
    }
}
