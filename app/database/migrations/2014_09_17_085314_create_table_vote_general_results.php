<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableVoteGeneralResults extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vote_general_results', function(Blueprint $table)
		{
			$table->integer('user_id')->unsigned();
			$table->integer('vote_id')->unsigned();
			$table->integer('mark')->unsigned();
			$table->primary(['vote_id','user_id']);
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
		Schema::drop('vote_general_results');
	}

}
