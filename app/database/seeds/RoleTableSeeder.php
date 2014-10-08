<?php
 
class RoleTableSeeder extends Seeder {
 
  public function run()
  {
    Role::create(array('name' => 'Trưởng bộ phận'));
    Role::create(array('name' => 'Truỏng ban'));
    Role::create(array('name' => 'Lãnh đạo'));
    Role::create(array('name' => 'Trưởng phòng'));

    Role::create(array('name' => 'Trưởng chi nhánh trực tiếp'));
  }
 
}
