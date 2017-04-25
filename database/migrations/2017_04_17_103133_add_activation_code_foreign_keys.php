<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddActivationCodeForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activation_codes', function (Blueprint $table) {
            $table->foreign('guest_id')->references('id')->on('guests');
            $table->foreign('event_id')->references('id')->on('events');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activation_codes', function (Blueprint $table) {
            $table->dropForeign('activation_codes_guest_id_foreign');
            $table->dropForeign('activation_codes_event_id_foreign');
        });
    }
}
