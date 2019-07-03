<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DCustomerremovable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_customerremovable', function (Blueprint $table) {
            $table->bigIncrements('cr_id');
            $table->string('cr_serial',100)->index();
            $table->string('cr_plate',20);
            $table->string('cr_typecar',50);
            $table->string('cr_jobdesc',100);
            $table->date('cr_dateservice')->nullable();
            $table->string('cr_serviceadvisor',30);
            $table->string('cr_code',100);
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
        Schema::dropIfExists('d_customerremovable');

    }
}
