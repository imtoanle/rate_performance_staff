<?php
 
class CriteriaTableSeeder extends Seeder {
 
  public function run()
  {
    Criteria::create(array(
      'name' => 'Điểm cơ bản',
    ));
  }
 
}
