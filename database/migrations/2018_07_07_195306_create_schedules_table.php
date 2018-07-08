<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {    
        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('id');            
            $table->integer('doctor')->unsigned();
            $table->foreign('doctor')->references('id')->on('doctors');
            $table->integer('patient')->unsigned();       
            $table->foreign('patient')->references('id')->on('patients');
            $table->date('date');
            $table->string('time');
            $table->string('name');
            $table->string('description');
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
        Schema::dropIfExists('schedules');
    }
}
