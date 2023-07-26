<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained();
            $table->foreignId('methodpay_id')->constrained();
            $table->string('kode_pemesanan');
            $table->string('email')->unique();
            $table->string('nm_member');
            $table->string('telephone');
            $table->string('alamat_pengiriman')->nullable();
            $table->integer('jml_transaksi');
            $table->string('metode_pembayaran');
            $table->string('status_bayar');
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
