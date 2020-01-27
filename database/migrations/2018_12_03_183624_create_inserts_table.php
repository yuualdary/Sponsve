<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Insert table untuk memasukkan gambar
        Schema::create('inserts', function (Blueprint $table) {
            $table->increments('insert_id');
            $table->integer('user_id')->unsigned();
            $table->string('title');
            $table->text('caption');
            $table->text('photo');
            $table->string('location');
            $table->string('category');
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
        Schema::dropIfExists('inserts');
    }
}
