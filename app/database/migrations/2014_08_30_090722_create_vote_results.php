<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoteResults extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vote_results', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('vote_id');
			$table->integer('voter_id');
			$table->integer('entitled_vote_id');
			$table->string('mark');
			$table->string('content');
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
		Schema::drop('vote_results');
	}

}
