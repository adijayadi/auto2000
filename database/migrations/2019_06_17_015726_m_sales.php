<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_sales', function (Blueprint $table) {
            $table->bigIncrements('s_id');
            $table->string('s_name',100);
            $table->string('s_email',100)->unique();
            $table->string('s_nphone',14);
            $table->string('s_address',150);
            $table->string('s_username',100);
            $table->string('password',150);
            $table->string('s_code',20);
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
        Schema::dropIfExists('m_sales');
    }
}
