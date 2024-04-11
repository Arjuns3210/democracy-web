<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrolledUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrolled_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contest_id')->unsigned();//termprory i am using id after review i will user json data
            $table->integer('user_id')->unsigned();
            $table->enum('status', [1, 0])->default(1);
            $table->unique(['contest_id','user_id']);
            $table->foreign('contest_id')->references('id')->on('contests')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('enrolled_users');
    }
}
