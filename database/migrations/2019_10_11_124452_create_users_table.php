<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{

    public function up()
    {
        Schema::create('users', function(Blueprint $table) {
            $table->increments('id');
            $table->string('first_name'); //I
            $table->string('second_name'); //F
            $table->string('middle_name'); //O
            $table->string('login');
            $table->string('password');
            $table->integer('role_id');
            $table->integer('post_id');
            $table->integer('department_id');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone_city')->nullable();
            $table->string('photo')->nullable();
            // Constraints declaration
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('users');
    }
}
