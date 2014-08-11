<?php
 
class GroupTableSeeder extends Seeder {
 
  public function run()
  {
    Sentry::createGroup(array(
        'id' => 1,
        'name'        => 'Admin',
        'permissions' => array(
            'superuser' => 1
        ),
    ));

    Sentry::createGroup(array(
        'id' => 2,
        'name'        => 'Client',
        'permissions' => array(),
    ));
  }
 
}