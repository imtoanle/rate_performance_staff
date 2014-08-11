<?php
 
class ApiTableSeeder extends Seeder {
 
  public function run()
  {
    $api = Api::create(array(
      'name' => 'Site Unlockerhub (IMEI Service)',
      'site' => 'www.ifactoryunlocker.com',
      'username' => 'ktoanlba',
      'api_key' => '6W1-B6I-3FQ-DKR-610-4SO-M8W-2T8',
      'type_api' => 1,
      'active' => 1,
      ));
  }
 
}