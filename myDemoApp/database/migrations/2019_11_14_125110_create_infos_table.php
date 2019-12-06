<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('outline'); // 개요
            $table->string('objective'); // 목표
            //$table->unsignedBigInteger('timetable_id'); 
            //$table->unsignedBigInteger('place_id');
            $table->timestamps();

            //$table->foreign('timetable_id')->references('id')->on('timetable')->onDelete('cascade');
            //$table->foreign('place_id')->references('id')->on('place')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('infos');
    }
}
