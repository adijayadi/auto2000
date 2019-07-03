<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DRecap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_recap', function (Blueprint $table) {
            $table->bigIncrements('re_id');
            $table->string('re_dataadded',100);
            $table->string('re_availabledata',100);
            $table->string('re_totaldata',100);
            $table->string('re_dateupload',100);
            $table->string('re_ccustomer',100)->unique();
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
        Schema::dropIfExists('m_reason');
    }
}
