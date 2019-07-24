<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_user', function (Blueprint $table) {
            $table->bigIncrements('u_id');
            $table->string('u_name',50);
            $table->string('u_username',50);
            $table->string('u_email',50)->nullable();
            $table->string('password');
            $table->string('u_cmenu',50)->nullable();
            $table->string('u_group',50)->nullable();
            $table->enum('u_user',['A','S','U'])->nullable()->comment('Admin','Staff','unknown');
            $table->string('u_code',20);
            $table->dateTime('u_lastlogin')->nullable();
            $table->dateTime('u_lastlogout')->nullable();
            $table->dateTime('u_create_at');
            $table->dateTime('u_update_at');
            $table->string('status_data',20)->nullable();

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('d_user');
    }
}
