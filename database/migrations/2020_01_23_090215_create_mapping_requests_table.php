<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMappingRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('mapping_requests', function (Blueprint $table) {
            $table->increments('Mapping_Req_Id');
            $table->integer('req_sponsorid');
            $table->integer('req_userid');
            $table->integer('req_status');
            $table->integer('req_fromcompany');
            $table->integer('req_fromevent');
            $table->date('req_created_at')->nullable();
            $table->date('req_modified_at')->nullable();
            $table->integer('req_modified_by')->nullable();

        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mapping_requests');
    }
}
