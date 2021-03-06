<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PomodoroTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Project', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });
        
        Schema::create('Story', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('priority');
            $table->integer('projectID')->reference('id')->on('Project');
        });
        
        Schema::create('Task', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('priority');
            $table->integer('estPomos');
            $table->integer('usedPomos')->default(0);
            $table->integer('storyID')->reference('id')->on('Story');
        });
        
        Schema::create('Pomodoro', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('taskID')->reference('id')->on('Task');
            $table->integer('seq');
            $table->time('addedTime');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('Project');
        Schema::drop('Story');
        Schema::drop('Task');
        Schema::drop('Pomodoro');
    }
}
