<?php
 
class StatementTableSeeder extends Seeder {
 
  public function run()
  {
    $faker = Faker\Factory::create();

    for ($i=1;$i<=100;$i++)
    {
      $invoice = Invoice::find($faker->numberBetween($min = 1, $max = 50));
      $amount = $faker->randomFloat($nbMaxDecimals = NULL, $min = 5, $max = 50);
      $balance = 50+$amount;
      Statement::create(array(
        'client_id' => $invoice->client_id,
        'desc' => $faker->sentence($nbWords = 6),
        'type' => $faker->numberBetween($min = 1, $max = 3),
        'amount' => $amount,
        'balance' => 50+$amount,  
        'sid' => $invoice->id,  
        ));
    }
  }
 
}
