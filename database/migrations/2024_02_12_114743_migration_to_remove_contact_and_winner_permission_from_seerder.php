<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class MigrationToRemoveContactAndWinnerPermissionFromSeerder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Artisan::call('db:seed',[
            '--class' => 'RevertContactPermissionSeeder',
            '--force' => true
        ]);

        Artisan::call('db:seed',[
            '--class' => 'RevertWinnersPermissionSeeder',
            '--force' => true
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Artisan::call('db:seed',[
            '--class' => 'AddContactPermissionSeeder',
            '--force' => true
        ]);

        Artisan::call('db:seed',[
            '--class' => 'AddWinnersPermissionSeeder',
            '--force' => true
        ]);
    }
}
