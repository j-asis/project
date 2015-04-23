<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Project extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user', function($table)
        {
            $table->increments('id');
            $table->string('username');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->string('avatar');
            $table->string('password');
            $table->string('status');
            $table->string('type');
            $table->timestamps();
        });

        Schema::create('post', function($table)
        {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('creator');
            $table->string('content');
            $table->timestamps();
        });

        Schema::create('friend', function($table)
        {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('friend_id');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('user');
        Schema::drop('post');
        Schema::drop('friend');
    }

}
