<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableToColumnsOfTableOnlineReservations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('online_reservations', function (Blueprint $table) {
            $table->string('mobile')->nullable()->change();
            $table->string('telephone')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->dateTime('reservations_time')->nullable()->change();
            $table->string('type')->nullable()->change();
            $table->integer('duration')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
