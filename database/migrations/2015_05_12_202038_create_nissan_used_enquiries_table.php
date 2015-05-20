<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNissanUsedEnquiriesTable extends Migration {

	public function up()
	{
		Schema::create('nissan_used_enquiries', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('dealership_id')->unsigned();
			$table->foreign('dealership_id')->references('id')->on('nissan_dealerships')->onDelete('cascade');
			$table->string('vid');		
			$table->string('firstname');
			$table->string('surname');
			$table->string('email');
			$table->string('tel');
			$table->string('enquiry_type');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('nissan_used_enquiries');
	}

}
