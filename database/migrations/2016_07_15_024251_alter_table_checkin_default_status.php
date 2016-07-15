<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableCheckinDefaultStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('checkins', function (Blueprint $table) {
            $table->string('status', 1)->default('A')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('checkins', function (Blueprint $table) {
            $table->string('status', 1)->default('R')->change();
        });
    }
}
