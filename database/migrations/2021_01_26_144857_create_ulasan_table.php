<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUlasanTable extends Migration
{    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ulasan', function (Blueprint $table) {            
            $table->id();
            $table->string('kode_transaksi', 50)->index();
            $table->unsignedBigInteger('id_kendaraan')->index();
            $table->unsignedBigInteger('id_pelanggan')->index();
            $table->string('telp', 15);
            $table->string('nama', 100);
            $table->integer('rating');
            $table->text('ulasan');
            $table->timestamp('created_at');
            $table->tinyInteger('status')->default('0');
            $table->foreign('id_pelanggan')->references('id')->on('pelanggan')->onDelete('cascade');
            $table->foreign('id_kendaraan')->references('id_kendaraan')->on('kendaraan')->onDelete('cascade');
            $table->foreign('kode_transaksi')->references('kode_transaksi')->on('transaksi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ulasan');
    }
}
