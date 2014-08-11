<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('code');
			$table->integer('client_id');
			$table->text('bulk_imei');
			$table->string('comment');
			$table->string('response_email');
			$table->timestamps();
			$table->integer('service_id');
			$table->integer('service_group_id')->default(1);
			$table->integer('status')->default(1);
			$table->decimal('amount', 13);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('orders');
	}

}
