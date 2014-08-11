<?php

class PricingsTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('pricings')->truncate();
        
		\DB::table('pricings')->insert(array (
			0 => 
			array (
				'id' => '1',
				'service_id' => '1',
				'client_group_id' => '1',
				'pricing' => '0.35',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			1 => 
			array (
				'id' => '2',
				'service_id' => '1',
				'client_group_id' => '2',
				'pricing' => '0.35',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			2 => 
			array (
				'id' => '3',
				'service_id' => '2',
				'client_group_id' => '1',
				'pricing' => '0.60',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			3 => 
			array (
				'id' => '4',
				'service_id' => '2',
				'client_group_id' => '2',
				'pricing' => '0.60',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			4 => 
			array (
				'id' => '5',
				'service_id' => '3',
				'client_group_id' => '1',
				'pricing' => '0.20',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			5 => 
			array (
				'id' => '6',
				'service_id' => '3',
				'client_group_id' => '2',
				'pricing' => '0.20',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			6 => 
			array (
				'id' => '7',
				'service_id' => '4',
				'client_group_id' => '1',
				'pricing' => '0.22',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			7 => 
			array (
				'id' => '8',
				'service_id' => '4',
				'client_group_id' => '2',
				'pricing' => '0.22',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			8 => 
			array (
				'id' => '9',
				'service_id' => '5',
				'client_group_id' => '1',
				'pricing' => '0.55',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			9 => 
			array (
				'id' => '10',
				'service_id' => '5',
				'client_group_id' => '2',
				'pricing' => '0.55',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			10 => 
			array (
				'id' => '11',
				'service_id' => '6',
				'client_group_id' => '1',
				'pricing' => '0.25',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			11 => 
			array (
				'id' => '12',
				'service_id' => '6',
				'client_group_id' => '2',
				'pricing' => '0.25',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			12 => 
			array (
				'id' => '13',
				'service_id' => '7',
				'client_group_id' => '1',
				'pricing' => '1.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			13 => 
			array (
				'id' => '14',
				'service_id' => '7',
				'client_group_id' => '2',
				'pricing' => '1.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			14 => 
			array (
				'id' => '15',
				'service_id' => '8',
				'client_group_id' => '1',
				'pricing' => '14.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			15 => 
			array (
				'id' => '16',
				'service_id' => '8',
				'client_group_id' => '2',
				'pricing' => '14.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			16 => 
			array (
				'id' => '17',
				'service_id' => '9',
				'client_group_id' => '1',
				'pricing' => '19.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			17 => 
			array (
				'id' => '18',
				'service_id' => '9',
				'client_group_id' => '2',
				'pricing' => '19.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			18 => 
			array (
				'id' => '19',
				'service_id' => '10',
				'client_group_id' => '1',
				'pricing' => '120.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			19 => 
			array (
				'id' => '20',
				'service_id' => '10',
				'client_group_id' => '2',
				'pricing' => '120.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			20 => 
			array (
				'id' => '21',
				'service_id' => '11',
				'client_group_id' => '1',
				'pricing' => '22.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			21 => 
			array (
				'id' => '22',
				'service_id' => '11',
				'client_group_id' => '2',
				'pricing' => '22.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			22 => 
			array (
				'id' => '23',
				'service_id' => '12',
				'client_group_id' => '1',
				'pricing' => '27.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			23 => 
			array (
				'id' => '24',
				'service_id' => '12',
				'client_group_id' => '2',
				'pricing' => '27.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			24 => 
			array (
				'id' => '25',
				'service_id' => '13',
				'client_group_id' => '1',
				'pricing' => '31.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			25 => 
			array (
				'id' => '26',
				'service_id' => '13',
				'client_group_id' => '2',
				'pricing' => '31.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			26 => 
			array (
				'id' => '27',
				'service_id' => '14',
				'client_group_id' => '1',
				'pricing' => '36.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			27 => 
			array (
				'id' => '28',
				'service_id' => '14',
				'client_group_id' => '2',
				'pricing' => '36.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			28 => 
			array (
				'id' => '29',
				'service_id' => '15',
				'client_group_id' => '1',
				'pricing' => '47.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			29 => 
			array (
				'id' => '30',
				'service_id' => '15',
				'client_group_id' => '2',
				'pricing' => '47.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			30 => 
			array (
				'id' => '31',
				'service_id' => '16',
				'client_group_id' => '1',
				'pricing' => '83.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			31 => 
			array (
				'id' => '32',
				'service_id' => '16',
				'client_group_id' => '2',
				'pricing' => '83.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			32 => 
			array (
				'id' => '33',
				'service_id' => '17',
				'client_group_id' => '1',
				'pricing' => '127.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			33 => 
			array (
				'id' => '34',
				'service_id' => '17',
				'client_group_id' => '2',
				'pricing' => '127.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			34 => 
			array (
				'id' => '35',
				'service_id' => '18',
				'client_group_id' => '1',
				'pricing' => '18.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			35 => 
			array (
				'id' => '36',
				'service_id' => '18',
				'client_group_id' => '2',
				'pricing' => '18.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			36 => 
			array (
				'id' => '37',
				'service_id' => '19',
				'client_group_id' => '1',
				'pricing' => '19.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			37 => 
			array (
				'id' => '38',
				'service_id' => '19',
				'client_group_id' => '2',
				'pricing' => '19.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			38 => 
			array (
				'id' => '39',
				'service_id' => '20',
				'client_group_id' => '1',
				'pricing' => '70.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			39 => 
			array (
				'id' => '40',
				'service_id' => '20',
				'client_group_id' => '2',
				'pricing' => '70.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			40 => 
			array (
				'id' => '41',
				'service_id' => '21',
				'client_group_id' => '1',
				'pricing' => '22.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			41 => 
			array (
				'id' => '42',
				'service_id' => '21',
				'client_group_id' => '2',
				'pricing' => '22.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			42 => 
			array (
				'id' => '43',
				'service_id' => '22',
				'client_group_id' => '1',
				'pricing' => '105.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			43 => 
			array (
				'id' => '44',
				'service_id' => '22',
				'client_group_id' => '2',
				'pricing' => '105.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			44 => 
			array (
				'id' => '45',
				'service_id' => '23',
				'client_group_id' => '1',
				'pricing' => '16.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			45 => 
			array (
				'id' => '46',
				'service_id' => '23',
				'client_group_id' => '2',
				'pricing' => '16.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			46 => 
			array (
				'id' => '47',
				'service_id' => '24',
				'client_group_id' => '1',
				'pricing' => '18.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			47 => 
			array (
				'id' => '48',
				'service_id' => '24',
				'client_group_id' => '2',
				'pricing' => '18.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			48 => 
			array (
				'id' => '49',
				'service_id' => '25',
				'client_group_id' => '1',
				'pricing' => '26.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			49 => 
			array (
				'id' => '50',
				'service_id' => '25',
				'client_group_id' => '2',
				'pricing' => '26.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			50 => 
			array (
				'id' => '51',
				'service_id' => '26',
				'client_group_id' => '1',
				'pricing' => '30.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			51 => 
			array (
				'id' => '52',
				'service_id' => '26',
				'client_group_id' => '2',
				'pricing' => '30.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			52 => 
			array (
				'id' => '53',
				'service_id' => '27',
				'client_group_id' => '1',
				'pricing' => '26.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			53 => 
			array (
				'id' => '54',
				'service_id' => '27',
				'client_group_id' => '2',
				'pricing' => '26.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			54 => 
			array (
				'id' => '55',
				'service_id' => '28',
				'client_group_id' => '1',
				'pricing' => '34.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			55 => 
			array (
				'id' => '56',
				'service_id' => '28',
				'client_group_id' => '2',
				'pricing' => '34.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			56 => 
			array (
				'id' => '57',
				'service_id' => '29',
				'client_group_id' => '1',
				'pricing' => '34.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			57 => 
			array (
				'id' => '58',
				'service_id' => '29',
				'client_group_id' => '2',
				'pricing' => '34.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			58 => 
			array (
				'id' => '59',
				'service_id' => '30',
				'client_group_id' => '1',
				'pricing' => '34.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			59 => 
			array (
				'id' => '60',
				'service_id' => '30',
				'client_group_id' => '2',
				'pricing' => '34.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			60 => 
			array (
				'id' => '61',
				'service_id' => '31',
				'client_group_id' => '1',
				'pricing' => '94.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			61 => 
			array (
				'id' => '62',
				'service_id' => '31',
				'client_group_id' => '2',
				'pricing' => '94.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			62 => 
			array (
				'id' => '63',
				'service_id' => '32',
				'client_group_id' => '1',
				'pricing' => '127.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			63 => 
			array (
				'id' => '64',
				'service_id' => '32',
				'client_group_id' => '2',
				'pricing' => '127.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			64 => 
			array (
				'id' => '65',
				'service_id' => '33',
				'client_group_id' => '1',
				'pricing' => '135.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			65 => 
			array (
				'id' => '66',
				'service_id' => '33',
				'client_group_id' => '2',
				'pricing' => '135.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			66 => 
			array (
				'id' => '67',
				'service_id' => '34',
				'client_group_id' => '1',
				'pricing' => '160.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			67 => 
			array (
				'id' => '68',
				'service_id' => '34',
				'client_group_id' => '2',
				'pricing' => '160.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			68 => 
			array (
				'id' => '69',
				'service_id' => '35',
				'client_group_id' => '1',
				'pricing' => '5.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			69 => 
			array (
				'id' => '70',
				'service_id' => '35',
				'client_group_id' => '2',
				'pricing' => '5.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			70 => 
			array (
				'id' => '71',
				'service_id' => '36',
				'client_group_id' => '1',
				'pricing' => '9.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			71 => 
			array (
				'id' => '72',
				'service_id' => '36',
				'client_group_id' => '2',
				'pricing' => '9.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			72 => 
			array (
				'id' => '73',
				'service_id' => '37',
				'client_group_id' => '1',
				'pricing' => '89.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			73 => 
			array (
				'id' => '74',
				'service_id' => '37',
				'client_group_id' => '2',
				'pricing' => '89.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			74 => 
			array (
				'id' => '75',
				'service_id' => '38',
				'client_group_id' => '1',
				'pricing' => '68.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			75 => 
			array (
				'id' => '76',
				'service_id' => '38',
				'client_group_id' => '2',
				'pricing' => '68.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			76 => 
			array (
				'id' => '77',
				'service_id' => '39',
				'client_group_id' => '1',
				'pricing' => '68.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			77 => 
			array (
				'id' => '78',
				'service_id' => '39',
				'client_group_id' => '2',
				'pricing' => '68.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			78 => 
			array (
				'id' => '79',
				'service_id' => '40',
				'client_group_id' => '1',
				'pricing' => '17.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			79 => 
			array (
				'id' => '80',
				'service_id' => '40',
				'client_group_id' => '2',
				'pricing' => '17.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			80 => 
			array (
				'id' => '81',
				'service_id' => '41',
				'client_group_id' => '1',
				'pricing' => '71.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			81 => 
			array (
				'id' => '82',
				'service_id' => '41',
				'client_group_id' => '2',
				'pricing' => '71.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			82 => 
			array (
				'id' => '83',
				'service_id' => '42',
				'client_group_id' => '1',
				'pricing' => '19.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			83 => 
			array (
				'id' => '84',
				'service_id' => '42',
				'client_group_id' => '2',
				'pricing' => '19.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			84 => 
			array (
				'id' => '85',
				'service_id' => '43',
				'client_group_id' => '1',
				'pricing' => '6.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			85 => 
			array (
				'id' => '86',
				'service_id' => '43',
				'client_group_id' => '2',
				'pricing' => '6.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			86 => 
			array (
				'id' => '87',
				'service_id' => '44',
				'client_group_id' => '1',
				'pricing' => '17.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			87 => 
			array (
				'id' => '88',
				'service_id' => '44',
				'client_group_id' => '2',
				'pricing' => '17.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			88 => 
			array (
				'id' => '89',
				'service_id' => '45',
				'client_group_id' => '1',
				'pricing' => '11.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			89 => 
			array (
				'id' => '90',
				'service_id' => '45',
				'client_group_id' => '2',
				'pricing' => '11.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			90 => 
			array (
				'id' => '91',
				'service_id' => '46',
				'client_group_id' => '1',
				'pricing' => '7.25',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			91 => 
			array (
				'id' => '92',
				'service_id' => '46',
				'client_group_id' => '2',
				'pricing' => '7.25',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			92 => 
			array (
				'id' => '93',
				'service_id' => '47',
				'client_group_id' => '1',
				'pricing' => '19.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			93 => 
			array (
				'id' => '94',
				'service_id' => '47',
				'client_group_id' => '2',
				'pricing' => '19.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			94 => 
			array (
				'id' => '95',
				'service_id' => '48',
				'client_group_id' => '1',
				'pricing' => '9.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			95 => 
			array (
				'id' => '96',
				'service_id' => '48',
				'client_group_id' => '2',
				'pricing' => '9.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			96 => 
			array (
				'id' => '97',
				'service_id' => '49',
				'client_group_id' => '1',
				'pricing' => '11.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			97 => 
			array (
				'id' => '98',
				'service_id' => '49',
				'client_group_id' => '2',
				'pricing' => '11.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			98 => 
			array (
				'id' => '99',
				'service_id' => '50',
				'client_group_id' => '1',
				'pricing' => '65.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			99 => 
			array (
				'id' => '100',
				'service_id' => '50',
				'client_group_id' => '2',
				'pricing' => '65.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			100 => 
			array (
				'id' => '101',
				'service_id' => '51',
				'client_group_id' => '1',
				'pricing' => '5.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			101 => 
			array (
				'id' => '102',
				'service_id' => '51',
				'client_group_id' => '2',
				'pricing' => '5.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			102 => 
			array (
				'id' => '103',
				'service_id' => '52',
				'client_group_id' => '1',
				'pricing' => '4.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			103 => 
			array (
				'id' => '104',
				'service_id' => '52',
				'client_group_id' => '2',
				'pricing' => '4.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			104 => 
			array (
				'id' => '105',
				'service_id' => '53',
				'client_group_id' => '1',
				'pricing' => '11.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			105 => 
			array (
				'id' => '106',
				'service_id' => '53',
				'client_group_id' => '2',
				'pricing' => '11.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			106 => 
			array (
				'id' => '107',
				'service_id' => '54',
				'client_group_id' => '1',
				'pricing' => '11.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			107 => 
			array (
				'id' => '108',
				'service_id' => '54',
				'client_group_id' => '2',
				'pricing' => '11.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			108 => 
			array (
				'id' => '109',
				'service_id' => '55',
				'client_group_id' => '1',
				'pricing' => '4.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			109 => 
			array (
				'id' => '110',
				'service_id' => '55',
				'client_group_id' => '2',
				'pricing' => '4.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			110 => 
			array (
				'id' => '111',
				'service_id' => '56',
				'client_group_id' => '1',
				'pricing' => '17.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			111 => 
			array (
				'id' => '112',
				'service_id' => '56',
				'client_group_id' => '2',
				'pricing' => '17.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			112 => 
			array (
				'id' => '113',
				'service_id' => '57',
				'client_group_id' => '1',
				'pricing' => '25.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			113 => 
			array (
				'id' => '114',
				'service_id' => '57',
				'client_group_id' => '2',
				'pricing' => '25.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			114 => 
			array (
				'id' => '115',
				'service_id' => '58',
				'client_group_id' => '1',
				'pricing' => '4.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			115 => 
			array (
				'id' => '116',
				'service_id' => '58',
				'client_group_id' => '2',
				'pricing' => '4.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			116 => 
			array (
				'id' => '117',
				'service_id' => '59',
				'client_group_id' => '1',
				'pricing' => '4.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			117 => 
			array (
				'id' => '118',
				'service_id' => '59',
				'client_group_id' => '2',
				'pricing' => '4.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			118 => 
			array (
				'id' => '119',
				'service_id' => '60',
				'client_group_id' => '1',
				'pricing' => '11.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			119 => 
			array (
				'id' => '120',
				'service_id' => '60',
				'client_group_id' => '2',
				'pricing' => '11.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			120 => 
			array (
				'id' => '121',
				'service_id' => '61',
				'client_group_id' => '1',
				'pricing' => '27.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			121 => 
			array (
				'id' => '122',
				'service_id' => '61',
				'client_group_id' => '2',
				'pricing' => '27.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			122 => 
			array (
				'id' => '123',
				'service_id' => '62',
				'client_group_id' => '1',
				'pricing' => '29.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			123 => 
			array (
				'id' => '124',
				'service_id' => '62',
				'client_group_id' => '2',
				'pricing' => '29.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			124 => 
			array (
				'id' => '125',
				'service_id' => '63',
				'client_group_id' => '1',
				'pricing' => '6.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			125 => 
			array (
				'id' => '126',
				'service_id' => '63',
				'client_group_id' => '2',
				'pricing' => '6.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			126 => 
			array (
				'id' => '127',
				'service_id' => '64',
				'client_group_id' => '1',
				'pricing' => '6.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			127 => 
			array (
				'id' => '128',
				'service_id' => '64',
				'client_group_id' => '2',
				'pricing' => '6.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			128 => 
			array (
				'id' => '129',
				'service_id' => '65',
				'client_group_id' => '1',
				'pricing' => '6.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			129 => 
			array (
				'id' => '130',
				'service_id' => '65',
				'client_group_id' => '2',
				'pricing' => '6.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			130 => 
			array (
				'id' => '131',
				'service_id' => '66',
				'client_group_id' => '1',
				'pricing' => '18.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			131 => 
			array (
				'id' => '132',
				'service_id' => '66',
				'client_group_id' => '2',
				'pricing' => '18.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			132 => 
			array (
				'id' => '133',
				'service_id' => '67',
				'client_group_id' => '1',
				'pricing' => '94.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			133 => 
			array (
				'id' => '134',
				'service_id' => '67',
				'client_group_id' => '2',
				'pricing' => '94.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			134 => 
			array (
				'id' => '135',
				'service_id' => '68',
				'client_group_id' => '1',
				'pricing' => '93.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			135 => 
			array (
				'id' => '136',
				'service_id' => '68',
				'client_group_id' => '2',
				'pricing' => '93.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			136 => 
			array (
				'id' => '137',
				'service_id' => '69',
				'client_group_id' => '1',
				'pricing' => '6.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			137 => 
			array (
				'id' => '138',
				'service_id' => '69',
				'client_group_id' => '2',
				'pricing' => '6.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			138 => 
			array (
				'id' => '139',
				'service_id' => '70',
				'client_group_id' => '1',
				'pricing' => '71.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			139 => 
			array (
				'id' => '140',
				'service_id' => '70',
				'client_group_id' => '2',
				'pricing' => '71.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			140 => 
			array (
				'id' => '141',
				'service_id' => '71',
				'client_group_id' => '1',
				'pricing' => '69.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			141 => 
			array (
				'id' => '142',
				'service_id' => '71',
				'client_group_id' => '2',
				'pricing' => '69.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			142 => 
			array (
				'id' => '143',
				'service_id' => '72',
				'client_group_id' => '1',
				'pricing' => '2.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			143 => 
			array (
				'id' => '144',
				'service_id' => '72',
				'client_group_id' => '2',
				'pricing' => '2.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			144 => 
			array (
				'id' => '145',
				'service_id' => '73',
				'client_group_id' => '1',
				'pricing' => '29.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			145 => 
			array (
				'id' => '146',
				'service_id' => '73',
				'client_group_id' => '2',
				'pricing' => '29.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			146 => 
			array (
				'id' => '147',
				'service_id' => '74',
				'client_group_id' => '1',
				'pricing' => '12.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			147 => 
			array (
				'id' => '148',
				'service_id' => '74',
				'client_group_id' => '2',
				'pricing' => '12.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			148 => 
			array (
				'id' => '149',
				'service_id' => '75',
				'client_group_id' => '1',
				'pricing' => '6.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			149 => 
			array (
				'id' => '150',
				'service_id' => '75',
				'client_group_id' => '2',
				'pricing' => '6.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			150 => 
			array (
				'id' => '151',
				'service_id' => '76',
				'client_group_id' => '1',
				'pricing' => '4.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			151 => 
			array (
				'id' => '152',
				'service_id' => '76',
				'client_group_id' => '2',
				'pricing' => '4.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			152 => 
			array (
				'id' => '153',
				'service_id' => '77',
				'client_group_id' => '1',
				'pricing' => '4.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			153 => 
			array (
				'id' => '154',
				'service_id' => '77',
				'client_group_id' => '2',
				'pricing' => '4.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			154 => 
			array (
				'id' => '155',
				'service_id' => '78',
				'client_group_id' => '1',
				'pricing' => '6.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			155 => 
			array (
				'id' => '156',
				'service_id' => '78',
				'client_group_id' => '2',
				'pricing' => '6.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			156 => 
			array (
				'id' => '157',
				'service_id' => '79',
				'client_group_id' => '1',
				'pricing' => '6.50',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			157 => 
			array (
				'id' => '158',
				'service_id' => '79',
				'client_group_id' => '2',
				'pricing' => '6.50',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			158 => 
			array (
				'id' => '159',
				'service_id' => '80',
				'client_group_id' => '1',
				'pricing' => '12.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			159 => 
			array (
				'id' => '160',
				'service_id' => '80',
				'client_group_id' => '2',
				'pricing' => '12.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			160 => 
			array (
				'id' => '161',
				'service_id' => '81',
				'client_group_id' => '1',
				'pricing' => '4.50',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			161 => 
			array (
				'id' => '162',
				'service_id' => '81',
				'client_group_id' => '2',
				'pricing' => '4.50',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			162 => 
			array (
				'id' => '163',
				'service_id' => '82',
				'client_group_id' => '1',
				'pricing' => '26.50',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			163 => 
			array (
				'id' => '164',
				'service_id' => '82',
				'client_group_id' => '2',
				'pricing' => '26.50',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			164 => 
			array (
				'id' => '165',
				'service_id' => '83',
				'client_group_id' => '1',
				'pricing' => '15.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			165 => 
			array (
				'id' => '166',
				'service_id' => '83',
				'client_group_id' => '2',
				'pricing' => '15.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			166 => 
			array (
				'id' => '167',
				'service_id' => '84',
				'client_group_id' => '1',
				'pricing' => '21.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			167 => 
			array (
				'id' => '168',
				'service_id' => '84',
				'client_group_id' => '2',
				'pricing' => '21.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			168 => 
			array (
				'id' => '169',
				'service_id' => '85',
				'client_group_id' => '1',
				'pricing' => '21.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
			169 => 
			array (
				'id' => '170',
				'service_id' => '85',
				'client_group_id' => '2',
				'pricing' => '21.00',
				'created_at' => '2014-07-08 08:22:03',
				'updated_at' => '2014-07-08 08:22:03',
			),
		));
	}

}
