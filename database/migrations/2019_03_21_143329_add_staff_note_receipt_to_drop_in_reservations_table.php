<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStaffNoteReceiptToDropInReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('drop_in_reservations', function (Blueprint $table) {
            $table->string('staff')->nullable();
            $table->string('note')->nullable();
            $table->string('receipt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('drop_in_reservations', function (Blueprint $table) {
            //
        });
    }
}
