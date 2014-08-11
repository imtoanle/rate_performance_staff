<?php
 
class InvoiceTableSeeder extends Seeder {
 
  public function run()
  {
    $faker = Faker\Factory::create();

    for ($i=1;$i<=100;$i++)
    {
      $item_price = $faker->randomFloat($nbMaxDecimals = 0, $min = 5, $max = 50);
      $transaction_tax = number_format($item_price*Config::get('variable.transaction_tax')/100, 2);
      $total_price = number_format($item_price+$transaction_tax, 2);
      Invoice::create(array(
        'client_id' => Client::orderBy(DB::raw('RAND()'))->first()->id,
        'item_name' => $faker->sentence($nbWords = 4),
        'item_price' => $item_price,
        'item_number' => 1,
        'item_qlt' => 1,
        'transaction_tax' => $transaction_tax,
        'total_price' => $total_price,
        'status' => $faker->numberBetween($min = 1, $max = 2),
        'admin_created' => $faker->numberBetween($min = 1, $max = 2),
        ));
    }
  }
 
}
