<?php
 
class UserTableSeeder extends Seeder {
 
  public function run()
  {
    $faker = Faker\Factory::create();

    /*
    for ($i=1;$i<=1;$i++)
    {
      $username = $i==1 ? 'admin' : $faker->userName;
      $jobIds = '';
      $job_titles = JobTitle::orderByRaw("RAND()")->take(3)->get();
      foreach ($job_titles as $job) {
        $jobIds .= $job->id.',';
      }

      $jobIds = trim($jobIds, ',');

      $user = Sentry::createUser(array(
        'id' => $i,
        'email' => $faker->email,
        'username' => $username,
        'password' => '123123',
        'activated' => true,
        'full_name' => $faker->name($gender = NULL),
        'phone_num' => $faker->phoneNumber,
        'birth_date' => $faker->dateTimeThisCentury($max = 'now'),
        'department_id' => Department::orderByRaw("RAND()")->first()->id,
        'job_title' => $jobIds,
        ));

      $idGroup = $i==1 ? 1 : $faker->numberBetween($min = 1, $max = 2);
      $randomGroup = Sentry::findGroupById($idGroup);
      $user->addGroup($randomGroup);

    }
    */

    $user = Sentry::createUser(array(
        'email' => $faker->email,
        'username' => 'admin',
        'password' => '123123',
        'activated' => true,
        'full_name' => $faker->name($gender = NULL),
        'phone_num' => $faker->phoneNumber,
        'birth_date' => $faker->dateTimeThisCentury($max = 'now'),
        ));

      $adminGroup = Sentry::findGroupById(1);
      $user->addGroup($adminGroup);
  }
 
}
