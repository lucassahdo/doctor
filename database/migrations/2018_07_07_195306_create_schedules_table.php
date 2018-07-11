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
            $table->string('purpose');
            $table->string('details'); 
            $table->integer('doctor')->unsigned();
            $table->foreign('doctor')->references('id')->on('doctors');
            $table->integer('patient')->unsigned();       
            $table->foreign('patient')->references('id')->on('patients');
            $table->integer('created_by')->unsigned();       
            $table->foreign('created_by')->references('id')->on('users')     
                                ->onDelete('cascade')
                                ->onUpdate('cascade');
            $table->date('date');
            $table->string('time');
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
