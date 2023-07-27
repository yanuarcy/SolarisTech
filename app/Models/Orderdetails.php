<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderdetails extends Model
{
    use HasFactory;

    protected $table = 'orderdetails';

    protected $fillable = [
        'order_id',
        'product_id',
        'nm_member',
        'nm_barang',
        'jml_barang',
        'total_harga'
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
