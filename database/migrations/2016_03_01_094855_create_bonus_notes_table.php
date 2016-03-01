<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBonusNotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bonus_notes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();

			$table->string('notes');
			$table->integer('bonus_id')->unsigned();
			$table->foreign('bonus_id')->references('id')->on('bonuses');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('bonus_notes');
	}

}
