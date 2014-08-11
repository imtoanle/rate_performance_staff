<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clients', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('clientgroup_id');
			$table->string('username');
			$table->string('email');
			$table->string('name');
			$table->string('password');
			$table->string('password_temp');
			$table->string('remember_token');
			$table->string('code');
			$table->integer('active');
			$table->timestamps();
			$table->string('phone');
			$table->string('address');
			$table->string('address2');
			$table->string('city');
			$table->string('state');
			$table->string('zip_code');
			$table->string('country');
			$table->string('language');
			$table->string('security_question');
			$table->string('security_answer');
			$table->text('security_login');
			$table->string('settings');
			$table->decimal('amount', 13);
			$table->integer('client_group')->default(1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('clients');
	}

}
