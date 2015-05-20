<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNissanGeneralEnquiriesTable extends Migration {

	public function up()
	{
		Schema::create('nissan_general_enquiries', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('dealership_id')->unsigned();
			$table->foreign('dealership_id')->references('id')->on('nissan_dealerships')->onDelete('cascade');
			$table->string('firstname');
			$table->string('surname');
			$table->string('email');
			$table->string('tel');
			$table->text('message');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('nissan_general_enquiries');
	}

}
