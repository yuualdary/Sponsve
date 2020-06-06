<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('company_id');
            $table->string('company_name');
            $table->text('company_address');
            $table->integer('company_phone');
            $table->string('website_address');
            $table->string('status_company');
            $table->text('social_media');
            $table->text('company_photo');
            $table->boolean('isapprove_company')->nullable();
            $table->date('comp_created_at')->nullable();
            $table->date('comp_modified_at')->nullable();
            $table->integer('comp_modified_by')->nullable();
           
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
