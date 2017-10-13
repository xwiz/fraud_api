<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFraudaccountFraudcasePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fraudaccount_fraudcase', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fraud_case_id')->unsigned()->index();
            $table->foreign('fraud_case_id')->references('id')->on('fraud_cases')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('fraud_account_id')->unsigned()->index();
            $table->foreign('fraud_account_id')->references('id')->on('fraud_accounts')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::drop('fraudaccount_fraudcase');
    }
}
