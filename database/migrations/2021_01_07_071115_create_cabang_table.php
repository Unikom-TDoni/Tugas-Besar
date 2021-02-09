<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCabangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cabang', function (Blueprint $table) {
            $table->id('id_cabang');
            $table->string('nama_cabang', 100);
            $table->string('telp', 15);
            $table->unsignedBigInteger('id_kota');
            $table->unsignedBigInteger('id_provinsi');
            $table->text('alamat');
            $table->integer('is_aktif')->default(1);
            $table->foreign('id_kota')->references('id')->on('kota')->onDelete('cascade');
            $table->foreign('id_provinsi')->references('id')->on('provinsi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cabang');
    }
}
