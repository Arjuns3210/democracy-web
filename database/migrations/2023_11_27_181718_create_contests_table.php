<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContestsTable extends Migration
{
    public function up()
    {
        Schema::create('contests', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['Online', 'Offline'])->default('Online');
            $table->string('contest_code')->nullable();
            $table->string('name');
            $table->longText('contest_details');
            $table->integer('location_id')->nullable();
            $table->enum('on_tv', ['Yes', 'No']);
            $table->longText('winning_award')->nullable();
            $table->longText('rules')->nullable();
            $table->double('fees')->default(0.0);
            $table->longText('image');
            $table->date('contest_date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->date('registration_allowed_until')->nullable();
            $table->enum('cancellation_allowed', ['Yes', 'No'])->default('yes');
            $table->enum('status', [1, 0])->default(1);
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    public function down()
    {
        Schema::dropIfExists('contests');
    }
}
