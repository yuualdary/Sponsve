<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // untuk melakukan comment pada view detail image

        Schema::create('comments', function (Blueprint $table) {
            $table->increments('cmntid');
            $table->string('name');
            $table->text('comment');
            $table->integer('user_commentid');
            $table ->integer('item_id')->nullable();
            $table ->integer('company_commentid')->nullable();
            $table ->integer('proposal_commentid')->nullable();

            $table->datetime('comment_created_at')->nullable();
            $table->datetime('comment_modified_at')->nullable();
            $table->integer('comment_modified_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
