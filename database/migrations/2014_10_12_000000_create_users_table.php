<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone_code', 10)->default('91');
            $table->string('phone', 20);
            $table->enum('gender', ['M', 'F', 'O'])->default('M');
            $table->string('whatsapp_no', 10)->nullable();
            $table->date('dob')->nullable();
            $table->string('password')->nullable();
            $table->string('image')->nullable();
            $table->string('address')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('state_id')->nullable();
            $table->string('pin_code')->nullable();
            $table->string('approval_status')->default('accepted')->comment('pending|accepted|rejected');
            $table->datetime('approved_on')->nullable();
            $table->integer('approved_by')->default(0)->comment('Admin Id');
            $table->longText('admin_remark')->nullable();
            $table->enum('login_allowed', [1, 0])->default(1);
            $table->enum('otp_allowed', [1, 0])->default(1);
            $table->enum('password_allowed', [1, 0])->default(1);
            $table->enum('sms_notification', [1, 0])->default(1);
            $table->enum('email_notification', [1, 0])->default(1);
            $table->enum('fcm_notification', [1, 0])->default(1);
            $table->enum('whatsapp_notification', [1, 0])->default(1);
            $table->enum('fpwd_flag', ['Y', 'N'])->default('N');
            $table->datetime('last_login')->nullable();
            $table->enum('is_verified', ['Y', 'N'])->default('N');
            $table->timestamp('phone_verified_at')->nullable();
            $table->rememberToken();
            $table->enum('status', [1, 0])->default(1);
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
