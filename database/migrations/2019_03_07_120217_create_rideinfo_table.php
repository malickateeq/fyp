<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRideinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rideinfo', function (Blueprint $table) {
            $table->increments('info_id');
            $table->integer('total_seats')->nullable();
            $table->integer('reserved_seats')->nullable();
            $table->string('v_type')->nullable();
            $table->string('fare')->nullable();
            $table->string('passengers')->nullable()->default('Male/Female');
            $table->time('departure_time')->nullable();
            $table->time('arrival_time')->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('rideinfo');
    }
}
