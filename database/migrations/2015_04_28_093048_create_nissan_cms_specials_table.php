<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNissanCmsSpecialsTable extends Migration {

	public function up()
	{
		Schema::create('nissan_cms_specials', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('dealer_id');
			$table->string('image_path');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('nissan_cms_specials');
	}

}
