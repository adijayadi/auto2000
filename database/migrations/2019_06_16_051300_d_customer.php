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
            $table->string('c_serial',100)->index();
            $table->string('c_plate');
            $table->string('c_typecar');
            $table->string('c_jobdesc');
            $table->string('c_dateservice');
            $table->string('c_serviceadvisor');
            $table->string('c_code');
            $table->timestamp('created_at')->nullable();
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
