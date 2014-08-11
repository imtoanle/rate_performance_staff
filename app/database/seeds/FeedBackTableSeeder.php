<?php
 
class FeedBackTableSeeder extends Seeder {
 
  public function run()
  {
    $faker = Faker\Factory::create();

    for ($i=1;$i<=20;$i++)
    {
      FeedBack::create(array(
        'name' => $faker->name($gender = NULL),
        'subject' => $faker->sentence($nbWords = 6),
        'content' => $faker->paragraph($nbSentences = 3),
        'type' => $faker->numberBetween($min = 1, $max = 2),
        ));

    }
  }
 
}
