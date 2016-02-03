<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBonusPayoutsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('bonus_payouts', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('key')->unique();
            $table->string('friendly_name');
            $table->string('payout');
            $table->string('description');

            $table->string('bonus_currency_id');
            $table->integer('currency_amount');

            // For things where bonus = 0 for accounting
            $table->boolean('hidden');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('bonus_payouts');
    }

}
