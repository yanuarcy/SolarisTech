<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 'methodpay_id', 'kode_pemesanan', 'email', 'nm_member',
        'telephone', 'alamat_pengiriman', 'jml_transaksi', 'metode_pembayaran',
        'status_bayar', 'photo',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function methodpay()
    {
        return $this->belongsTo(MethodPay::class);
    }
}
