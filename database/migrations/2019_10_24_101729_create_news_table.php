<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{

    public function up()
    {
        Schema::create('news', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('text');
            $table->string('photo');
            $table->integer('user_id');

            // Schema declaration
            // Constraints declaration
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('news');
    }
}
