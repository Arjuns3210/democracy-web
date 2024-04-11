<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeQuestionIdFiledNameIntoSuggestedQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suggested_question_options', function (Blueprint $table) {
            $table->dropForeign(['question_id']);
            $table->renameColumn('question_id','suggested_question_id');
            $table->foreign('suggested_question_id')->references('id')->on('suggested_questions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suggested_question_options', function (Blueprint $table) {
            $table->dropForeign(['suggested_question_id']);
            $table->renameColumn('suggested_question_id','question_id');
            $table->foreign('question_id')->references('id')->on('suggested_questions')->onDelete('cascade');
        });
    }
}
