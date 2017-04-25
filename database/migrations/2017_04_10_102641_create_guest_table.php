<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('last_name')->nullable()->default(null);
            $table->string('first_name')->nullable()->default(null);
            $table->string('nick_name');
            $table->string('facebook_credentials')->unique()->nullable()->default(null);
            $table->string('email')->unique()->nullable()->default(null);
            $table->string('password')->nullable()->default(null);

            $table->integer('suggestion_credit');
            $table->dateTime('suggestion_timeout');

            $table->integer('guest_priviledge_id')->unsigned();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guests');
    }
}
