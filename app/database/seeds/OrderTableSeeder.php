<?php
 
class OrderTableSeeder extends Seeder {
 
  public function run()
  {
    $faker = Faker\Factory::create();

    for ($i=1;$i<=5000;$i++)
    {
      $service = Service::find($faker->numberBetween($min = 1, $max = 85));
      $created_at = $faker->dateTimeThisYear($max = 'now');
      Order::create(array(
        'client_id' => Client::orderBy(DB::raw('RAND()'))->first()->id,
        'bulk_imei' => $faker->numerify($string = '##############'),
        'comment' => $faker->paragraph($nbSentences = 2),
        'response_email' => $faker->email,

        'service_id' => $service->id,
        'service_group_id' => $service->getCatId(),

        'status' => $faker->numberBetween($min = 1, $max = 4),
        'amount' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 5, $max = 50),
        'created_at' => $created_at,
        'updated_at' => $created_at,
        ));
    }
  }
 
}
