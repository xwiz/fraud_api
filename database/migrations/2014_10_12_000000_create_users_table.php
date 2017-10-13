<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 20);
			$table->string('last_name', 30)->nullable();
            $table->string('email', 50)->unique()->index();
            $table->string('phone_number', 15)->nullable()->index();
            $table->char('password', 64);
            $table->rememberToken();
            $table->timestamps();


            $table->unique(['email', 'phone_number']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
