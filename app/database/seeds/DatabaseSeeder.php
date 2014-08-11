<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('PermissionsTableSeeder');
		#$this->call('PermissionTableSeeder');
		$this->call('GroupTableSeeder');
		$this->call('UserTableSeeder');

		$this->call('SettingsTableSeeder');
		$this->call('SourceCatsTableSeeder');
		$this->call('SourceServicesTableSeeder');

		$this->call('ServiceCatsTableSeeder');
		$this->call('ServicesTableSeeder');

		$this->call('PricingsTableSeeder');


		$this->call('ApiTableSeeder');
		$this->call('BlogTableSeeder');		

		$this->call('ClientGroupTableSeeder');		
		$this->call('ClientTableSeeder');		
		$this->call('CommentTableSeeder');		
		$this->call('FeedBackTableSeeder');		
		$this->call('InvoiceTableSeeder');		
		
		$this->call('PagesTableSeeder');
		$this->call('PaymentsTableSeeder');
		
		$this->call('SuppliersTableSeeder');
		$this->call('StatementTableSeeder');

		$this->call('LoginLogTableSeeder');
		$this->call('OrderTableSeeder');
		
	}

}
