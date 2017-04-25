<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSuggestionForeignKeys extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('suggestions', function (Blueprint $table) {
            $table->foreign('event_id')->references('id')->on('events');
            $table->foreign('song_id')->references('id')->on('songs');
            $table->foreign('guest_id')->references('id')->on('guests');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('suggestions', function (Blueprint $table) {
            $table->dropForeign('suggestions_event_id_foreign');
            $table->dropForeign('suggestions_song_id_foreign');
            $table->dropForeign('suggestions_guest_id_foreign');
        });
    }
}
