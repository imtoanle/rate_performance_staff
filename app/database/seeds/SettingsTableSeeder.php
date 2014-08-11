<?php

class SettingsTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('settings')->truncate();
        
		\DB::table('settings')->insert(array (
			0 => 
			array (
				'key' => 'address',
				'value' => '54 Thái Nguyên - Nha Trang - Khánh Hòa',
			),
			1 => 
			array (
				'key' => 'company',
				'value' => 'APUNLOCK',
			),
			2 => 
			array (
				'key' => 'description',
				'value' => 'APUNLOCK là website cung cấp dịnh vụ unlock qua IMEI, FILE, SERVER các dòng smartphone.',
			),
			3 => 
			array (
				'key' => 'email',
				'value' => 'ktoanlba@gmail.com',
			),
			4 => 
			array (
				'key' => 'keywords',
				'value' => 'unlock, iphone, samsung, htc, blackberry, motorola, imei service',
			),
			5 => 
			array (
				'key' => 'phone',
				'value' => '+84 932550039',
			),
			6 => 
			array (
				'key' => 'skype',
				'value' => 'ktoanlba89',
			),
		));
	}

}
