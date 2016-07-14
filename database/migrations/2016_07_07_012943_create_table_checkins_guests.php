<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCheckinsGuests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('checkins_guests')) {
            Schema::drop('checkins_guests');
        }
        Schema::create('checkins_guests', function (Blueprint $table) {
            $table->integer('guest_id')->unsigned();
            $table->integer('checkin_id')->unsigned();
            $table->primary(['guest_id', 'checkin_id']);

            $table->foreign('guest_id')->references('id')->on('guests');
            $table->foreign('checkin_id')->references('id')->on('checkins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('checkins_guests');
    }
}
