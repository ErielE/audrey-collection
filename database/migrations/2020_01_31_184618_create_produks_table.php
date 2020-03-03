<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->string('slug');
            //ADAPUN category_id NYA NNTI AKAN mengacu KE TABLE categories
            //DIMANA UNTUK SAAT INI BELUM AKAN DIBAHAS RELASI ANTAR TABLE-NYA
            $table->unsignedBigInteger('kategori_id');
            $table->text('deskripsi')->nullable();
            $table->string('gambar');
            $table->integer('harga');
            $table->integer('berat');
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
        Schema::dropIfExists('produks');
    }
}
