<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DFollowup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_followup', function (Blueprint $table) {
            $table->bigIncrements('fu_id');
            $table->string('fu_cid',100)->index();
            $table->string('fu_cstaff',100)->nullable();
            $table->date('fu_date')->nullable();
            $table->time('fu_time')->nullable();
            $table->date('fu_plandate')->nullable();
            $table->time('fu_plantime')->nullable();
            $table->date('fu_updatedate')->nullable();
            $table->time('fu_updatetime')->nullable();
            $table->date('fu_bookingdate')->nullable();
            $table->string('fu_status',20);
            $table->string('status_data',20);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('d_followup');   
    }
}
