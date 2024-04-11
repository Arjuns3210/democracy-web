<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorrectAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('correct_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('contest_id');
            $table->unsignedInteger('question_id');
            $table->unsignedInteger('option_id');
            $table->unsignedInteger('answer_count')->default(1);
            $table->foreign('contest_id')->references('id')->on('contests')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->foreign('option_id')->references('id')->on('question_options')->onDelete('cascade');
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
        Schema::dropIfExists('correct_answers');
    }
}
