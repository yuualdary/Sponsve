<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logusers', function (Blueprint $table) {
            $table->increments('log_id');
            $table->string('log_message')->nullable();
            $table->string('log_Status')->nullable();
            $table->integer('log_touserid')->nullable();
            $table->integer('log_fromcompanyid')->nullable();
            $table->integer('log_fromproposal')->nullable(); 
            $table->integer('log_createdby')->nullable();
            $table->date('log_createdon')->nullable();
            $table->date('log_modifiedon')->nullable();
            $table->integer('log_modifiedby')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logusers');
    }
}
