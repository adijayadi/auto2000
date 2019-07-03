<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MReason extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_reason', function (Blueprint $table) {
            $table->bigIncrements('r_id');
            $table->string('r_reason',100);
            $table->string('r_group',100);
            $table->string('r_code',15);
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
