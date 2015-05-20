<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUniqueConstraintToCarCategoriesTable extends Migration {

	public function up()
	{
		Schema::table('nissan_new_car_categories', function(Blueprint $table)
		{
			$table->unique('category');
		});
	}

	public function down()
	{
		Schema::table('nissan_new_car_categories', function(Blueprint $table)
		{
			//$table->dropUnique('category');
		});
	}

}
