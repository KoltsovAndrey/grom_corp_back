<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentsTable extends Migration
{

    public function up()
    {
        Schema::create('departments', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('full_name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone_city')->nullable();
            // Constraints declaration
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('departments');
    }
}
