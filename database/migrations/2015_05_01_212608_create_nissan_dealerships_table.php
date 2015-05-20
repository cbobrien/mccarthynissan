<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNissanDealershipsTable extends Migration {

	public function up()
	{
		Schema::create('nissan_dealerships', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->text('address');
			$table->string('longitude');
			$table->string('latitude');
			$table->string('tel');
			$table->string('fax');
			$table->text('hours');
			$table->text('blurb');
			$table->string('image_path');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('nissan_dealerships');
	}

}
