<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCoynumberFieldNissanDealerships extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('nissan_dealerships', function(Blueprint $table)
		{
			$table->string('coynumber');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('nissan_dealerships', function(Blueprint $table)
		{
			$table->dropColumn('coynumber');
		});
	}

}
