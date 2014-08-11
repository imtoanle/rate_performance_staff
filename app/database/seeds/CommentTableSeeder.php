<?php
 
class CommentTableSeeder extends Seeder {
 
  public function run()
  {
    $faker = Faker\Factory::create();

    for ($i=1;$i<=100;$i++)
    {
      Comment::create(array(
        'name' => $faker->firstName($gender = NULL),
        'email' => $faker->email,
        'content' => $faker->paragraph($nbSentences = 3),
        'blog_id' => $faker->numberBetween($min = 1, $max = 50),
        ));

    }
  }
 
}
