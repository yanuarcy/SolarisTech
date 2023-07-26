<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transaksis')->insert([
            [
                'id' => 1,
                'order_id' => 1,
                'methodpay_id' => 1,
                'kode_pemesanan' => '22SNWC2K',
                'email' => 'user@gmail.com',
                'nm_member' => 'user',
                'telephone' => '0812-3456-7890',
                'alamat_pengiriman' => 'JL. Medokan Sawah Timur VI E, 7',
                'jml_transaksi' => 18600000,
                'metode_pembayaran' => 'BCA',
                'status_bayar' => 'sukses',
                'photo' => 'BuktiBayar.jpg'
            ],
            [
                'id' => 2,
                'order_id' => 2,
                'methodpay_id' => 4,
                'kode_pemesanan' => 'SIMAD28C',
                'email' => 'admin@gmail.com',
                'nm_member' => 'admin',
                'telephone' => '0123-4567-8901',
                'alamat_pengiriman' => 'Graha Asri Sukodono',
                'jml_transaksi' => 5700000,
                'metode_pembayaran' => 'DANA',
                'status_bayar' => 'belum bayar'
            ]
        ]);
    }
}
