<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBonusStatusesTable extends Migration {

    public function up() {
        Schema::create('bonus_statuses', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name')->unique();
        });
    }

    public function down() {
        Schema::drop('bonus_statuses');
    }

}