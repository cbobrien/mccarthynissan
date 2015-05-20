<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNissanNewCars extends Migration {

	public function up()
	{
		Schema::create('nissan_new_cars', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('category_id')->unsigned();
			$table->foreign('category_id')->references('id')->on('nissan_new_car_categories')->onDelete('cascade');
			$table->string('title');
			$table->text('description');
			$table->string('image_path');
			$table->string('brochure_link');
		    $table->string('specifications_link');		
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('nissan_new_cars');
	}

}
