<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFraudCaseFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fraud_case_files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fraud_case_id')->unsigned()->index();
            $table->string('picture_url', 255)->nullable();
            $table->boolean('is_fraudster_picture')->default(0);
            $table->foreign('fraud_case_id')->references('id')->on('fraud_cases')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('fraud_case_files');
    }
}
