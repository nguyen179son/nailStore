<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeReservationTimeColumnOfOnlineReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('online_reservations', function (Blueprint $table) {
            $table->string('reservation_time')->nullable()->change();
            $table->string('mobile')->nullable()->change();
            $table->string('telephone')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->string('type')->nullable()->change();
            $table->string('duration')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('online_reservations');
    }
}
