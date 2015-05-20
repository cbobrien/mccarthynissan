<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNissanPromotionEnquiriesTable extends Migration {

	public function up()
	{
		Schema::create('nissan_promotion_enquiries', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('promotion_id');
			$table->string('firstname');
			$table->string('surname');
			$table->string('email');
			$table->string('tel');
			$table->string('message');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('nissan_promotion_enquiries');
	}

}
