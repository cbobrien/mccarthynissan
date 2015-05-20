<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNissanNewCarVideosTable extends Migration {

	public function up()
	{
		Schema::create('nissan_new_car_videos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('car_id')->unsigned();
			$table->foreign('car_id')->references('id')->on('nissan_new_cars')->onDelete('cascade');
			$table->string('video_link');		
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('nissan_new_car_videos');
	}

}
