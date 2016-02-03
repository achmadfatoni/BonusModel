<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBonusTypeBonusPayoutOptionsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('bonus_type_bonus_payout_options', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('payout_id')->unsigned()->nullable();
            $table->integer('type_id')->unsigned();
            $table->foreign('payout_id')->references('id')->on('bonus_payouts');
            $table->foreign('type_id')->references('id')->on('bonus_types');
            
            $table->unique(['payout_id', 'type_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('bonus_type_bonus_payout_options');
    }

}
