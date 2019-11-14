<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('question_id')->index();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->text('comment');
            $table->string('user_email');
        
<<<<<<< HEAD
            $table->foreign('question_id')->references('id')->on('questions')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
=======
            $table->foreign('question_id')->references('id')->on('questions')
                        ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_email')->references('email')->on('users')
                        ->onUpdate('cascade')->onDelete('cascade');
>>>>>>> 2b15fd97ce299bc783a96ad441a23c2ce84951b1
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
