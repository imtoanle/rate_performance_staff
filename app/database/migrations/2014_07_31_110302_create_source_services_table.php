<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSourceServicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('source_services', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('api_id');
			$table->integer('service_cat_id');
			$table->integer('service_id');
			$table->string('service_name');
			$table->decimal('credit', 13);
			$table->string('delivery_time');
			$table->text('info');
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
		Schema::drop('source_services');
	}

}
