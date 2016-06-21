<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrawlerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crawler', function(Blueprint $table)
        {
            $table->increments('id');
            $table->text('news_link')->nullable();
           // $table->text('title')->nullable();
            $table->text('details')->nullable();
            $table->text('newspaper')->nullable();
            $table->text('date')->nullable();
            //$table->text('section')->nullable();
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
        Schema::drop('crawler');
    }
}
