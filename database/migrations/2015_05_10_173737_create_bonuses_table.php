<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBonusesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('bonuses', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->enum('workflow_status', ['New', 'ProcessedByReceiver', 'Paid', 'Void']);
            $table->integer('bonus_payout_id')->unsigned()->nullable();
            $table->integer('bonus_type_id')->unsigned();
            $table->integer('awarded_by_user_id')->unsigned();
            $table->integer('awarded_to_user_id')->unsigned();

            $table->foreign('bonus_payout_id')->references('id')->on('bonus_payouts');
            $table->foreign('bonus_type_id')->references('id')->on('bonus_types');
            $table->foreign('awarded_by_user_id')->references('id')->on('users');
            $table->foreign('awarded_to_user_id')->references('id')->on('users');

            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('bonuses');
    }

}
