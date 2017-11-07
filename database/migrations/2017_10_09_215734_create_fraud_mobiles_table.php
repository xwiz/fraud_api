<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFraudMobilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fraud_mobiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fraud_case_id')->unsigned();
            $table->foreign('fraud_case_id')->references('id')->on('fraud_cases')->onDelete('cascade')->onUpdate('cascade');
            $table->string('phone_number', 15)->nullable()->index();
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
        Schema::dropIfExists('fraud_mobiles');
    }
}
