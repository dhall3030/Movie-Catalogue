<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_details', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('tag_detail_id');
            $table->integer('tag_id')->unsigned()->index();
            $table->foreign('tag_id')->references('tag_id')->on('tags')->onDelete('cascade');
            $table->integer('movie_id')->unsigned()->index();
            $table->foreign('movie_id')->references('movie_id')->on('movies')->onDelete('cascade');
            
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag__details');
    }
}
