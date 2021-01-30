<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Transaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {       
            $table->string('kode_transaksi', 50);
            $table->date('tanggal_transaksi');
            $table->string('telp', 15);
            $table->string('nama', 100);
            $table->text('alamat');
            $table->string('nomor_ktp', 50);
            $table->unsignedBigInteger('id_kendaraan');
            $table->string('nomor_plat', 10);
            $table->date('tanggal_mulai_peminjaman');
            $table->date('tanggal_akhir_peminjaman');
            $table->tinyInteger('is_diantar')->default('0');
            $table->dateTime('waktu_antar')->nullable();
            $table->text('alamat_antar')->nullable();
            $table->double('harga_sewa');
            $table->double('denda');
            $table->double('total_bayar');
            $table->tinyInteger('status_transaksi')->default('0');
            $table->tinyInteger('status_pembayaran')->default('0');
            $table->tinyInteger('status_pengembalian')->default('0');
            $table->dateTime('waktu_pengembalian')->nullable();
            $table->primary('kode_transaksi');
            $table->foreign('id_kendaraan')->references('id_kendaraan')->on('kendaraan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}
