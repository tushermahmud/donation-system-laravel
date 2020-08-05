<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('entrepreneur_id')->unsigned();
            $table->foreign('entrepreneur_id')->references('id')->on('users')->onDelete('restrict');
            $table->string('title');
            $table->string('slug');
            $table->text('body');
            $table->text('image');
            $table->text('description');
            $table->text('additional');
            $table->text('goals');
            $table->integer('published_at')->default(0);
            $table->integer('donation_needed');
            $table->integer('total_collection');
            $table->softDeletes();
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
        Schema::dropIfExists('donations');
    }
}
