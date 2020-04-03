<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *  
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->increments('chat_id');
            $table->integer('from_chat_userid');
            $table->integer('to_chat_userid');
            $table->integer('from_chat_eventid');
            
            $table->text('chat_value');
            $table->text('chat_binary')->nullable();
            $table->date('chat_created_at')->nullable();
            $table->integer('chat_created_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chats');
    }
}
