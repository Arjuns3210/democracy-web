<?php

namespace Database\Seeders;
use App\Models\Permission;

use Illuminate\Database\Seeder;

class RevertGeneralSettingsPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = Permission::where('codename','general_settings')->pluck('id');
        Permission::find($permission)->delete();
    }
}
