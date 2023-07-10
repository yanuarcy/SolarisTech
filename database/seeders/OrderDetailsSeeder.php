<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('orderdetails')->insert([
            [
                'order_id' => 1,
                'product_id' => 1,
                'nm_member' => 'user',
                'nm_barang' => 'MSI RTX3070 VENTUS 3X 8GB GDDR6',
                'jml_barang' => 2,
                'total_harga' => 18600000
            ],
        ]);
    }
}
