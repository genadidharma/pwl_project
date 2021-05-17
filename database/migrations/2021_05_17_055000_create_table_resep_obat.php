<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableResepObat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resep_obat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pemeriksaan');
            $table->foreign('id_pemeriksaan')->references('id')->on('pemeriksaan');
            $table->unsignedBigInteger('id_barang');
            $table->foreign('id_barang')->references('id')->on('barang');
            $table->integer('jumlah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resep_obat');
    }
}
