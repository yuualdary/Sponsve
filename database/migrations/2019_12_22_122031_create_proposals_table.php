<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->increments('proposal_id');
            $table->integer('userid_proposal');
            $table->integer('ptid_proposal');
            $table->string('proposal_title');
            $table->text('proposal_description');
            $table->text('proposal_file');
            $table->integer('statusproposal_id');
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
        Schema::dropIfExists('propsals');
    }
}
