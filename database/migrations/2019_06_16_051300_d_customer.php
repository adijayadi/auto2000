<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DCustomer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_customer', function (Blueprint $table) {
            $table->bigIncrements('c_id');
            $table->string('c_serial',100)->index();
            $table->string('c_plate',20);
            $table->string('c_typecar',50);
            $table->string('c_jobdesc',100);
            $table->date('c_dateservice')->nullable();
            $table->date('c_dateplan')->nullable();
            $table->string('c_serviceadvisor',30)->nullable();
            $table->string('c_nameadvisor',100);
            $table->string('c_code',40);
            $table->string('c_order',10);
            $table->integer('c_countservice');
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
        Schema::dropIfExists('d_customer');
    }
}
