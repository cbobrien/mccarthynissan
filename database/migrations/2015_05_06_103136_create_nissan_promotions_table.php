<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNissanPromotionsTable extends Migration {


	public function up()
	{
		Schema::create('nissan_promotions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->integer('dealership_id')->unsigned();
			$table->foreign('dealership_id')->references('id')->on('nissan_dealerships')->onDelete('cascade');
			$table->tinyInteger('published');
			$table->string('image_path');
			$table->integer('order');
			$table->timestamp('expiry_date');
			$table->timestamps();
		});
	}


	public function down()
	{
		Schema::drop('nissan_promotions');
	}

}
