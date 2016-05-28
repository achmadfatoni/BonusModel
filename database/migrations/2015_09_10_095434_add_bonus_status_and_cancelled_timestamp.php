<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBonusStatusAndCancelledTimestamp extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		
		Artisan::call('db:seed', array('--force' => 'default', '--class' => Klsandbox\AddressModel\Database\Seeds\BonusStatusTableSeeder::class));
		
		Schema::table('bonuses', function(Blueprint $table)
		{
					$table->integer('bonus_status_id')->unsigned()->nullable();
                    $table->timestamp('canceled_at')->nullable();
		});
		
					
		Artisan::call('db:seed', array('--force' => 'default', '--class' => Klsandbox\AddressModel\Database\Seeds\DefaultBonusStatusColumnSeeder::class));
					
		DB::statement('ALTER TABLE bonuses MODIFY COLUMN bonus_status_id int UNSIGNED not null');
						
		Schema::table('bonuses', function(Blueprint $table)
		{
					$table->foreign('bonus_status_id')->references('id')->on('bonus_statuses');
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
            $table->dropForeign('bonuses_bonus_status_id_foreign');
			$table->dropColumn('bonus_status_id');
                    $table->dropColumn('canceled_at');
		});
	}

}
