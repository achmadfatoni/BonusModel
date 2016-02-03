<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddParentBonusId extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('bonuses', function(Blueprint $table)
		{
					$table->integer('parent_bonus_id')->unsigned()->nullable();
					$table->foreign('parent_bonus_id')->references('id')->on('bonuses');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('bonuses', function(Blueprint $table)
		{
            $table->dropForeign('bonuses_parent_bonus_id_foreign');
			$table->dropColumn('parent_bonus_id');
		});
	}

}
