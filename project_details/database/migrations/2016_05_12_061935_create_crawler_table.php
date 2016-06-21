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

//bad 
           $table->integer('rape')->default(0); 
           $table->integer('suicide')->default(0); 
           $table->integer('domestic_violence')->default(0); 
           $table->integer('doury')->default(0); 
           $table->integer('sexual_harassment')->default(0); 
           $table->integer('murder')->default(0); 


 //good
           $table->integer('power')->default(0); 
           $table->integer('job')->default(0); 
           $table->integer('education')->default(0);

           $table->integer('ovrrall')->default(0); 

           $table->string('type');  
           

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
