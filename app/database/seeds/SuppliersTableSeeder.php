<?php

class SuppliersTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('suppliers')->truncate();
        
		\DB::table('suppliers')->insert(array (
			0 => 
			array (
				'id' => '1',
				'username' => 'ktoanlba1',
				'password' => 'abcdef1123',
				'email' => 'ktoanlba1@gmail.com',
				'api' => '',
				'status' => '0',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '2014-05-23 15:36:47',
			),
		));
	}

}
