<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBonusCurrenciesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('bonus_currencies', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('key')->unique();
            $table->string('friendly_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('bonus_currencies');
    }

}
