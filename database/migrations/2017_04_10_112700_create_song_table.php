<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSongTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('songs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('spotify_song_id')->unique()->nullable()->default(null);
            $table->string('title');
            $table->string('artist');
            $table->string('img')->nullable()->default(null);
            $table->integer('duration_ms');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('songs');
    }
}
