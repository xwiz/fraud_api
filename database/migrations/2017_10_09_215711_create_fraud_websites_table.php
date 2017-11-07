<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFraudWebsitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fraud_websites', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fraud_case_id')->unsigned();
            $table->string('website_url', 155)->nullable();
            $table->integer('bank_id')->unsigned();
            $table->timestamps();
            
            
            $table->foreign('fraud_case_id')->references('id')->on('fraud_cases')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fraud_websites');
    }
}
