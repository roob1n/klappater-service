<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivationCodeTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('activation_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->integer('guest_id')->unsigned()->nullable()->default(null);
            $table->integer('event_id')->unsigned();
            $table->enum('status', array('used', 'valid', 'invalid', 'timedout'));

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('activation_codes');

    }
}
