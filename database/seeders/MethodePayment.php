<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MethodePayment extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('methodpays')->insert([
            [
                'id' => 1,
                'metode_pembayaran' => 'BCA',
                'no_rekening' => '0182400261',
                'nm_pemilik' => 'Julieta',
            ],
            [
                'id' => 2,
                'metode_pembayaran' => 'BNI',
                'no_rekening' => '21552673',
                'nm_pemilik' => 'Gellang',
            ],
            [
                'id' => 3,
                'metode_pembayaran' => 'ShopeePay',
                'no_rekening' => '082257508081',
                'nm_pemilik' => 'Yanuar',
            ],
            [
                'id' => 4,
                'metode_pembayaran' => 'DANA',
                'no_rekening' => '081336377045',
                'nm_pemilik' => 'Raffiel',
            ],
        ]);
    }
}
