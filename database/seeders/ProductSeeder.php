<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'kategori_id' => 4,
                'user_id' => 1,
                'nm_produk' => 'MSI RTX3070 VENTUS 3X 8GB GDDR6',
                'hg_produk' => 9300000,
                'stok' => 30,
                'desc_produk' => 'The GeForce RTX™ 3070 is powered by Ampere—NVIDIA’s 2nd gen RTX architecture. Built with enhanced RT Cores and Tensor Cores, new streaming multiprocessors, and high-speed G6 memory, it gives you the power you need to rip through the most demanding games.',
                'photo' => 'VGA3.jpg'
            ]
        ]);
    }
}
