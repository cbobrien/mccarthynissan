<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNissanCarEnquiriesTable extends Migration {

	public function up()
	{
		Schema::create('nissan_car_enquiries', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('dealership_id')->unsigned();
			$table->foreign('dealership_id')->references('id')->on('nissan_dealerships')->onDelete('cascade');
			$table->integer('car_id')->unsigned();
			$table->foreign('car_id')->references('id')->on('nissan_new_cars')->onDelete('cascade');
			$table->integer('version_id')->nullable;			
			$table->string('firstname');
			$table->string('surname');
			$table->string('email');
			$table->string('tel');
			$table->text('message')->nullable;
			$table->string('contact_time');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('nissan_car_enquiries');
	}

}
