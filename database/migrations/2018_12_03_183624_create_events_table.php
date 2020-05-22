<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateeventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //event table untuk memasukkan gambar
        Schema::create('events', function (Blueprint $table) {
            $table->increments('event_id');
            $table->integer('user_id')->unsigned();
            $table->string('title');
            $table->text('caption');
            $table->text('photo');
            $table->date('event_date');
            $table->string('location');
            $table->integer('category');
            $table->integer('event_company');
            $table->text('propo');
            $table->date('event_created_at')->nullable();
            $table->date('event_modified_at')->nullable();
            $table->integer('event_modified_by')->nullable();

       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
