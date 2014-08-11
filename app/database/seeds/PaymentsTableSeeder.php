<?php

class PaymentsTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('payments')->truncate();
        
		\DB::table('payments')->insert(array (
			0 => 
			array (
				'id' => '1',
				'invoice_id' => '17',
				'transaction_id' => '4LL86093FG130103K',
				'payer_id' => 'D38HNJWZAHR96',
				'token' => 'EC-9DX11892LF6135526',
				'payment_type' => '1',
				'status' => '2',
				'created_at' => '2014-05-15 12:27:40',
				'updated_at' => '2014-05-15 12:27:40',
			),
			1 => 
			array (
				'id' => '5',
				'invoice_id' => '18',
				'transaction_id' => '6F463479KC783382P',
				'payer_id' => 'D38HNJWZAHR96',
				'token' => 'EC-5W14134628030700D',
				'payment_type' => '1',
				'status' => '2',
				'created_at' => '2014-05-15 14:42:36',
				'updated_at' => '2014-05-15 14:42:36',
			),
			2 => 
			array (
				'id' => '6',
				'invoice_id' => '20',
				'transaction_id' => '2NY52983FA745063D',
				'payer_id' => 'D38HNJWZAHR96',
				'token' => 'EC-5WU97494XH7408643',
				'payment_type' => '1',
				'status' => '2',
				'created_at' => '2014-05-17 01:27:22',
				'updated_at' => '2014-05-17 01:27:22',
			),
		));
	}

}
