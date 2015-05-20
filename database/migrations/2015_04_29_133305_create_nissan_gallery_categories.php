<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNissanGalleryCategories extends Migration {

	public function up()
	{
		Schema::create('nissan_gallery_categories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('car_id')->unsigned();
			$table->foreign('car_id')->references('id')->on('nissan_new_cars')->onDelete('cascade');
			$table->string('type');
			$table->string('image_path');
			$table->string('title');
			$table->text('description');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('nissan_gallery_categories');
	}

}
