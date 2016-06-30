<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCheckin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkins', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('guest_id')->unsigned();
            $table->foreign('guest_id')->references('id')->on('guests')->onDelete('cascade');
            $table->integer('hotel_id')->unsigned();
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
            $table->char('status')->default('R');

            $table->string("email", 120);
            $table->string("fullname");
            $table->string("ocupation", 40);
            $table->string("nacionality", 30);
            $table->date("birthdate");
            $table->char('sex');

            $table->string("travelDocIssuingCountry", 30);
            $table->string("travelDocType", 20);
            $table->string("travelDocNumber", 20);
            $table->char("CPF", 11);
            $table->string("phone", 20);
            $table->string("cellphone", 20);

            $table->string("permanentAdress");
            $table->string("permanentZipcode", 20);
            $table->string("permanentCity");
            $table->string("state",10);
            $table->string("country", 40);

            $table->string("companyName", 50);
            $table->string("companyAdress");
            $table->string("companyZipcode", 20);

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
