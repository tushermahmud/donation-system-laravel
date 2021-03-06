<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('order_id')->unsigned();
            $table->integer('entrepreneur_id')->unsigned()->nullable();
            $table->foreign('entrepreneur_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('donation_id')->unsigned();
            $table->foreign('donation_id')->references('id')->on('donations')->onDelete('cascade');
            $table->string('order_status')->nullable();
            $table->integer('grand_total');
            $table->string('currency',3);

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
