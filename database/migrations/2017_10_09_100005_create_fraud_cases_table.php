<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFraudCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fraud_cases', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->date('scam_start_date')->nullable();
            $table->date('scam_realization_date')->nullable();
            $table->integer('severity_id')->unsigned();
            $table->double('amount_scammed_off', 10, 2)->unsigned();
            $table->integer('fraud_category_id')->unsigned()->index();
            $table->string('scammer_name');
            $table->string('scammer_real_name')->nullable();
            $table->integer('item_type_id')->unsigned();
            $table->string('item_name', 150)->nullable();
            $table->timestamps();


            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('severity_id')->references('id')->on('severities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('fraud_category_id')->references('id')->on('fraud_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('item_type_id')->references('id')->on('item_types')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fraud_cases');
    }
}
