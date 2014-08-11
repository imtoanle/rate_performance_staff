<?php

class PagesTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('pages')->truncate();
        
		\DB::table('pages')->insert(array (
			0 => 
			array (
				'id' => '1',
				'name' => 'about-us',
				'title' => 'Giới thiệu',
				'content' => 'Công ty chúng tôi là bla bla bla',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			1 => 
			array (
				'id' => '2',
				'name' => 'add-fund-bank',
				'title' => 'Nạp tiền qua ngân hàng',
				'content' => 'Để nạp tiền bằng NH nên làm như saoooo',
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
		));
	}

}
