<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertExportExcelPermissions extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::table('permissions')->insert(array (
			0 => 
			array (
				'name' => 'Xuất Excel',
				'value' => 'reports-management_export-excel',
			),
			1 => 
			array (
				'name' => 'Xuất Excel Tổng Hợp',
				'value' => 'reports-management_export-excel-general',
			),
		));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	}

}
