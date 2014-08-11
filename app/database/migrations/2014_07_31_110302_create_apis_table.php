<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateApisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('apis', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('site');
			$table->string('username');
			$table->string('api_key');
			$table->integer('type_api');
			$table->integer('active');
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
		Schema::drop('apis');
	}

}
