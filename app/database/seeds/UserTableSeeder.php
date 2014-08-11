<?php
 
class UserTableSeeder extends Seeder {
 
  public function run()
  {
    $faker = Faker\Factory::create();

    for ($i=1;$i<=5;$i++)
    {
      $username = $i==1 ? 'admin' : $faker->userName;

      $user = Sentry::createUser(array(
        'id' => $i,
        'email' => $faker->email,
        'username' => $username,
        'password' => '123123',
        'activated' => true,
        'full_name' => $faker->name($gender = NULL),
        'phone_num' => $faker->phoneNumber,
        'birth_date' => $faker->dateTimeThisCentury($max = 'now'),
        ));

      $idGroup = $i==1 ? 1 : $faker->numberBetween($min = 1, $max = 2);
      $randomGroup = Sentry::findGroupById($idGroup);
      $user->addGroup($randomGroup);

    }
  }
 
}
