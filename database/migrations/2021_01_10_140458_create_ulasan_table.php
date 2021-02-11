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
            $table->unsignedBigInteger('id_kendaraan')->index();
            $table->unsignedBigInteger('id_pelanggan')->index();
            $table->string('telp', 15);
            $table->string('nama', 100);
            $table->string('kode_transaksi', 50)->index();
            $table->integer('rating');
            $table->text('ulasan');
            $table->dateTime('waktu_ulasan');
            $table->tinyInteger('status')->default('0');
            $table->foreign('id_pelanggan')->references('id')->on('pelanggan')->onDelete('cascade');
            $table->foreign('id_kendaraan')->references('id_kendaraan')->on('kendaraan')->onDelete('cascade');
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
