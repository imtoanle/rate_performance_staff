<?php

class PermissionsTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('permissions')->truncate();
        
		\DB::table('permissions')->insert(array (
			0 => 
			array (
				'id' => '1',
				'name' => 'Super User',
				'value' => 'superuser',
				'description' => 'All permissions',
				'created_at' => '2014-04-30 09:35:34',
				'updated_at' => '2014-04-30 09:35:34',
			),
			1 => 
			array (
				'id' => '2',
				'name' => 'List Users',
				'value' => 'view-users-list',
				'description' => 'View the list of users',
				'created_at' => '2014-04-30 09:35:34',
				'updated_at' => '2014-04-30 09:35:34',
			),
			2 => 
			array (
				'id' => '3',
				'name' => 'Create user',
				'value' => 'create-user',
				'description' => 'Create new user',
				'created_at' => '2014-04-30 09:35:34',
				'updated_at' => '2014-04-30 09:35:34',
			),
			3 => 
			array (
				'id' => '4',
				'name' => 'Delete user',
				'value' => 'delete-user',
				'description' => 'Delete a user',
				'created_at' => '2014-04-30 09:35:35',
				'updated_at' => '2014-04-30 09:35:35',
			),
			4 => 
			array (
				'id' => '5',
				'name' => 'Update user',
				'value' => 'update-user-info',
				'description' => 'Update a user profile',
				'created_at' => '2014-04-30 09:35:35',
				'updated_at' => '2014-04-30 09:35:35',
			),
			5 => 
			array (
				'id' => '6',
				'name' => 'Update user group',
				'value' => 'user-group-management',
				'description' => 'Add/Remove a user in a group',
				'created_at' => '2014-04-30 09:35:35',
				'updated_at' => '2014-04-30 09:35:35',
			),
			6 => 
			array (
				'id' => '7',
				'name' => 'Groups management',
				'value' => 'groups-management',
			'description' => 'Manage group (CRUD)',
				'created_at' => '2014-04-30 09:35:35',
				'updated_at' => '2014-04-30 09:35:35',
			),
			7 => 
			array (
				'id' => '8',
				'name' => 'Permissions management',
				'value' => 'permissions-management',
			'description' => 'Manage permissions (CRUD)',
				'created_at' => '2014-04-30 09:35:35',
				'updated_at' => '2014-04-30 09:35:35',
			),
		));
	}

}
