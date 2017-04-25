<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGuestForeignKeys extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('guests', function (Blueprint $table) {
            $table->foreign('guest_priviledge_id')->references('id')->on('guest_priviledges');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('guests', function (Blueprint $table) {
            $table->dropForeign('guests_guest_priviledge_id_foreign');
        });
    }
}
