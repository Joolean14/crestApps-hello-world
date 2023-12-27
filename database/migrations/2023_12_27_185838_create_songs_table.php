<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs', function(Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->string('title', 255)->nullable();
            $table->string('album')->nullable();
            $table->integer('singer_id')->unsigned()->nullable()->index();
            $table->string('release_year')->nullable();
            $table->integer('song_category_id')->unsigned()->nullable()->index();
            $table->string('file')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('songs');
    }
}
