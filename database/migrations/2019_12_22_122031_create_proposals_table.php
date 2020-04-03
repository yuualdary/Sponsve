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
            $table->integer('eventid_proposal');
            $table->string('proposal_title');
            $table->text('proposal_description');
            $table->text('proposal_file');
            $table->integer('statusproposal_id');
            $table->date('proposal_created_at')->nullable();
            $table->date('proposal_modified_at')->nullable();
            $table->integer('proposal_modified_by')->nullable();
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
