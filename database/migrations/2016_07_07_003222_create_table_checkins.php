<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCheckins extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('checkins')) {
            Schema::drop('checkins');
        }

        Schema::create('checkins', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('hotel_id')->unsigned();
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');

            $table->char('status')->default('R');

            $table->string("arrivingFrom", 100);
            $table->string("nextDestination", 100);
            $table->char("purposeOfTrip");
            $table->char("ArrivingBy");
            $table->string("carPlate", 20);
            $table->timestamp('checkin');
            $table->string("companions", 100);
            $table->timestamp('checkout');
            $table->string('record');

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
        Schema::drop('checkins');
    }
}
