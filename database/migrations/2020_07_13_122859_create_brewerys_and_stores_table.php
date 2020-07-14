<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrewerysAndStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brewerys_and_stores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            // $table->int('clap')->default(0);
            $table->timestamps();
            $table->timestamp('token_expire_time',0)->nullable();
            $table->double('rate', 8, 1)->nullable();
            $table->string('address')->nullable();
            $table->string('note')->nullable();
            $table->string('gps_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brewerys_and_stores');
    }
}
