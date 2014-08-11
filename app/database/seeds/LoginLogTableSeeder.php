<?php
 
class LoginLogTableSeeder extends Seeder {
 
  public function run()
  {
    $faker = Faker\Factory::create();

    for ($i=1;$i<=100;$i++)
    {
      LogIP::create(array(
        'client_id' => Client::orderBy(DB::raw('RAND()'))->first()->id,
        'ip' => $faker->ipv4,
        ));
    }
  }
 
}
