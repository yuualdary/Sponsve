<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->increments('replies_id');
            $table->integer('comment_id'); 
            $table->integer('user_replyid');
            $table->string('reply');
            $table->date('rep_created_at')->nullable();
            $table->date('rep_modified_at')->nullable();
            $table->integer('rep_modified_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('replies');
    }
}
