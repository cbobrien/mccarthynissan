<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNissanNewCarColours extends Migration {

	public function up()
	{
		Schema::create('nissan_new_car_colours', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('car_id')->unsigned();
			$table->foreign('car_id')->references('id')->on('nissan_new_cars')->onDelete('cascade');
			$table->string('colour');
			$table->string('colour_code');
			$table->string('image_path');		
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('nissan_new_car_colours');
	}

}
