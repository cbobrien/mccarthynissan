<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNissanServicesTable extends Migration {

	public function up()
	{
		Schema::create('nissan_services', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('dealership_id')->unsigned();
			$table->foreign('dealership_id')->references('id')->on('nissan_dealerships')->onDelete('cascade');
			$table->string('firstname');
			$table->string('surname');
			$table->string('email');
			$table->string('tel');
			$table->string('make');
			$table->string('model');
			$table->string('series');
			$table->string('year');
			$table->text('work_required');
			$table->string('registration');
			$table->string('odometer');
			$table->string('date');
			$table->string('contact_time');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('nissan_services');
	}

}
