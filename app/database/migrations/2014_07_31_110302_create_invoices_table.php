<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInvoicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invoices', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('client_id');
			$table->string('item_name');
			$table->decimal('item_price', 13);
			$table->integer('item_number')->default(1);
			$table->integer('item_qlt');
			$table->decimal('transaction_tax', 13);
			$table->decimal('total_price', 13);
			$table->integer('status')->default(1);
			$table->timestamps();
			$table->dateTime('paid_at')->default('0000-00-00 00:00:00');
			$table->integer('admin_created')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('invoices');
	}

}
