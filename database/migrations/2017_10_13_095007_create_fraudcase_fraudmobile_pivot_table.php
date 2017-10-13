<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFraudcaseFraudmobilePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('fraudcase_fraudmobile', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fraud_case_id')->unsigned()->index();
            $table->foreign('fraud_case_id')->references('id')->on('fraud_cases')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('fraud_mobile_id')->unsigned()->index();
            $table->foreign('fraud_mobile_id')->references('id')->on('fraud_mobiles')->onDelete('cascade')->onUpdate('cascade');

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
        //
        Schema::drop('fraudcase_fraudmobile');
    }
}
