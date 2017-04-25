<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVoteForeignKeys extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('votes', function (Blueprint $table) {
            $table->foreign('guest_id')->references('id')->on('guests');
            $table->foreign('suggestion_id')->references('id')->on('suggestions');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('votes', function (Blueprint $table) {
            $table->dropForeign('votes_guest_id_foreign');
            $table->dropForeign('votes_suggestion_id_foreign');
        });
    }
}
