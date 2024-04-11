<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MigrationToChangeColumnInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('city_id');
            $table->dropColumn('state_id');
            $table->string('city_name')->nullable()->after('pin_code');
            $table->string('state_name')->nullable()->after('city_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('city_id')->nullable()->after('pin_code');
            $table->integer('state_id')->nullable()->after('city_id');
            $table->dropColumn('city_name');
            $table->dropColumn('state_name');
        });
    }
}
