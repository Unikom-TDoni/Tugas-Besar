<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Kendaraan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kendaraan', function (Blueprint $table) {
            $table->id('id_kendaraan');
            $table->string('nama_kendaraan', 50);
            $table->unsignedBigInteger('id_cabang');
            $table->string('merk', 50);
            $table->string('jenis', 10);
            $table->double('harga_sewa');
            $table->double('denda');
            $table->integer('jumlah_kendaraan');
            $table->integer('jumlah_terpakai')->default('0');
            $table->text('gambar')->default('');
            $table->foreign('id_cabang')->references('id_cabang')->on('cabang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kendaraan');
    }
}
