<?php
 
class ClientGroupTableSeeder extends Seeder {
 
  public function run()
  {
    ClientGroup::create(array('name' => 'Client'));
    ClientGroup::create(array('name' => 'Reseller'));
  }
 
}
