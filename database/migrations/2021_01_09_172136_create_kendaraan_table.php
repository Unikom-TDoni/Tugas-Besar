<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKendaraanTable extends Migration
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
            $table->unsignedBigInteger('id_cabang');
            $table->string('nama_kendaraan', 50);
            $table->string('merk', 50);
            $table->string('jenis', 10);
            $table->string('warna', 50);
            $table->year('tahun');
            $table->string('nomor_plat', 20);
            $table->double('harga_sewa');
            $table->double('denda');
            $table->text('gambar')->nullable();
            $table->tinyInteger('is_aktif')->default('1');
            $table->tinyInteger('is_tersedia')->default('1');
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
