<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            // $table->foreign('brewerys_and_stores_id')->references('id')->on('brewerys_and_stores');
            // $table->foreignId('')->constrained('');
            $table->unsignedInteger('brewerys_and_stores_id');
            $table->foreign('brewerys_and_stores_id')->references('id')->on('brewerys_and_stores');
            $table->string('name');
            $table->double('alc', 8, 1)->nullable();
            $table->integer('price')->nullable();
            $table->string('note')->nullable();
            $table->boolean('release')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
