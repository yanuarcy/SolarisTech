<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('orders')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'total_harga' => 18600000
            ],
            [
                'id' => 2,
                'user_id' => 2,
                'total_harga' => 5700000
            ]
        ]);
    }
}
