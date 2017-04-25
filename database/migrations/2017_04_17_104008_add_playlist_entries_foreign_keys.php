<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPlaylistEntriesForeignKeys extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('playlist_entries', function (Blueprint $table) {
            $table->foreign('event_id')->references('id')->on('events');
            $table->foreign('suggestion_id')->references('id')->on('suggestions');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('playlist_entries', function (Blueprint $table) {
            $table->dropForeign('playlist_entries_event_id_foreign');
            $table->dropForeign('playlist_entries_suggestion_id_foreign');
        });
    }
}
