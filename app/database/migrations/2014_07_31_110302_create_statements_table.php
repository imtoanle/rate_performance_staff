<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStatementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('statements', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('client_id');
			$table->string('desc');
			$table->integer('type');
			$table->decimal('amount', 13);
			$table->decimal('balance', 13);
			$table->integer('sid');
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
		Schema::drop('statements');
	}

}
