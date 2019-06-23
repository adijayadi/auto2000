<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MVehicle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_vehicle', function (Blueprint $table) {
            $table->bigIncrements('v_id');
            $table->string('v_owner',100);
            $table->string('v_nphone',15);
            $table->string('v_email',100);
            $table->string('v_address',100);
            $table->string('v_plate',20);
            $table->string('v_namecar',100);
            $table->string('v_code',20);
            $table->string('status_data',5);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_vehicle');
    }
}
