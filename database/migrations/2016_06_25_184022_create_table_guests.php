<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableGuests extends Migration
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
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('guest_id')->unsigned()->nullable();
            $table->foreign('guest_id')->references('id')->on('guests')->onDelete('cascade');

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
        Schema::drop('guests');
    }
}
