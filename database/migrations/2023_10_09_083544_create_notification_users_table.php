<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('notification_id');
            $table->integer('user_id');
            $table->enum('is_read', [0, 1])->default(0);
            $table->integer('batch_number')->nullable();
            $table->date('send_date')->nullable();
            $table->integer('user_device_id')->nullable();
            $table->enum('is_send',['1','0'])->default(0)->nullable();
            $table->text('response')->nullable();
            $table->dateTime('trigger_date')->nullable();
            $table->integer('attempt')->default(0)->nullable();
            $table->string('title')->nullable();
            $table->longText('body')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notification_users');
    }
}
