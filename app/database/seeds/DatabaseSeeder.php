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
		$this->call('GroupTableSeeder');
		#$this->call('DepartmentTableSeeder');
		#$this->call('JobTitleTableSeeder');
		$this->call('UserTableSeeder');
		#$this->call('VoteGroupTableSeeder');
		$this->call('CriteriaTableSeeder');
		$this->call('RoleTableSeeder');
	}

}
