<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('votes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('object_entitled_vote');
			$table->string('entitled_vote');
			$table->string('voter');
			$table->integer('status')->default(0);
			$table->string('criteria');
			$table->integer('vote_group_id');
			$table->integer('department_id');
			$table->softDeletes();
			$table->dateTime('expired_at')->nullable();
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
		Schema::drop('votes');
	}

}
