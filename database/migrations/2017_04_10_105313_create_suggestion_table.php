<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuggestionTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('suggestions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vote_count');
            $table->dateTime('life_time');
            $table->enum('status', array('active', 'dropped', 'chosen'));
            $table->integer('event_id')->unsigned();
            $table->integer('song_id')->unsigned();
            $table->integer('guest_id')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('suggestions');
    }
}
