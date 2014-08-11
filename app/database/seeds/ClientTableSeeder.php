<?php
 
class ClientTableSeeder extends Seeder {
 
  public function run()
  {
    $faker = Faker\Factory::create();

    for ($i=1;$i<=30;$i++)
    {
      $username = $i == 1 ? 'client' : $faker->unique()->userName;
      Client::create(array(
        'clientgroup_id' => $faker->numberBetween($min = 1, $max = 2),
        'email' => $faker->unique()->email,
        'username' => $username,
        'name' => $faker->name($gender = NULL),
        'password' => Hash::make('123123'),
        'active' => true,
        'phone' => $faker->phoneNumber,
        'address' => $faker->streetAddress,
        'city' => $faker->city,
        'state' => $faker->state,
        'zip_code' => $faker->postcode,
        'country' => $faker->country,
        'language' => $faker->languageCode,
        'security_question' => $faker->sentence($nbWords = 6),
        'security_answer' => $faker->sentence($nbWords = 6),
        'security_login' => $faker->ipv4,
        'amount' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL),
        ));

    }
  }
 
}
