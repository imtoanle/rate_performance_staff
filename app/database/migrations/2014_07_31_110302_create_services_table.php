<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('services', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('api_id');
			$table->integer('api_service_id');
			$table->string('name');
			$table->text('content');
			$table->decimal('credit', 13);
			$table->integer('active');
			$table->string('delivery_time');
			$table->integer('imei_service_cat_id');
			$table->integer('service_group_id');
			$table->integer('type');
			$table->timestamps();
			$table->string('settings');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('services');
	}

}
