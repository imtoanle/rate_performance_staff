<?php
 
class BlogTableSeeder extends Seeder {
 
  public function run()
  {
    $faker = Faker\Factory::create();

    for ($i=1;$i<=50;$i++)
    {
      $blog = Blog::create(array(
        'title' => $faker->sentence($nbWords = 6),
        'description' => $faker->paragraph($nbSentences = 3),
        'content' => $faker->text($maxNbChars = 200),
        'user_id' => $faker->numberBetween($min = 1, $max = 5),
        'cat_id' => $faker->randomDigitNotNull,
        'views' => $faker->randomNumber($nbDigits = NULL)
        ));
    }
  }
 
}