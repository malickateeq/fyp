<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDirectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('directions', function (Blueprint $table) {
            $table->increments('direction_id');
            $table->integer('user_id')->unsigned();
            $table->string('origin')->nullable();
            $table->string('destination')->nullable();
            $table->string('startAddr')->nullable();
            $table->string('endAddr')->nullable();
            $table->string('distance')->nullable();
            $table->string('duration')->nullable();
            $table->string('routeOf')->nullable();
            $table->string('wayPoints')->nullable();
            $table->string('stops', 2000)->nullable();
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
        Schema::dropIfExists('directions');

        //Drop existing table credentials
        // Latiude and Longitude
    }
}
