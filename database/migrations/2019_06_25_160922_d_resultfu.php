<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DResultfu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_resultfu', function (Blueprint $table) {
            $table->bigIncrements('rf_id');
            $table->string('rf_csummary',100)->index();
            $table->string('rf_cid',100)->nullable();
            $table->string('rf_count',30);
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
        Schema::dropIfExists('d_resultfu');
    }
}
