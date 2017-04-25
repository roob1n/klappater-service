<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestPriviledgeTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('guest_priviledges', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('max_suggestions');
            $table->integer('suggestion_timeout');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('guest_priviledges');
    }
}
