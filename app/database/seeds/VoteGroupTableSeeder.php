<?php
 
class VoteGroupTableSeeder extends Seeder {
 
  public function run()
  {
    /*
    $faker = Faker\Factory::create();

    for ($i=1;$i<=50;$i++)
    {
      VoteGroup::create(array(
        'vote_code' => $faker->lexify($string = '??????'),
        'title' => $faker->sentence($nbWords = 6),
        ));
    }
  }
 
}
