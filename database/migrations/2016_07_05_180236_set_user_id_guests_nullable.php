<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades;

class SetUserIdGuestsNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET foreign_key_checks = 0;');

        if (Schema::hasTable('guests')) {
            Schema::drop('guests');
        }

        Schema::create('guests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('guest_id')->unsigned()->nullable();
            $table->foreign('guest_id')->references('id')->on('guests')->onDelete('cascade');

            $table->string("email", 120)->nullable();
            $table->string("fullname")->nullable();
            $table->string("ocupation", 40)->nullable();
            $table->string("nacionality", 30)->nullable();
            $table->date("birthdate")->nullable();
            $table->char('sex')->nullable();

            $table->string("travelDocIssuingCountry", 30)->nullable();
            $table->string("travelDocType", 20)->nullable();
            $table->string("travelDocNumber", 20)->nullable();
            $table->char("CPF", 11)->nullable();
            $table->string("phone", 20)->nullable();
            $table->string("cellphone", 20)->nullable();

            $table->string("permanentAdress")->nullable();
            $table->string("permanentZipcode", 20)->nullable();
            $table->string("permanentCity")->nullable();
            $table->string("state",10)->nullable();
            $table->string("country", 40)->nullable();

            $table->string("companyName", 50)->nullable();
            $table->string("companyAdress")->nullable();
            $table->string("companyZipcode", 20)->nullable();

            $table->timestamps();
        });

        DB::statement('SET foreign_key_checks = 0;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET foreign_key_checks = 0;');
        Schema::drop('guests');
        DB::statement('SET foreign_key_checks = 1;');
    }
}
