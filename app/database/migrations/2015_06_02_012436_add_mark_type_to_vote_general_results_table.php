<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMarkTypeToVoteGeneralResultsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('vote_general_results', function(Blueprint $table)
		{
			$table->string('mark_type')->after('mark');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('vote_general_results', function(Blueprint $table)
		{
			//
		});
	}

}
