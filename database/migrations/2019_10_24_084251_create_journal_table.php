<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJournalTable extends Migration
{

    public function up()
    {
        Schema::create('journals', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('token')->nullable();
            $table->string('platform');
            $table->dateTime('time_login');
            $table->dateTime('time_logout')->nullable();
            // Schema declaration
            // Constraints declaration
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('journals');
    }
}
