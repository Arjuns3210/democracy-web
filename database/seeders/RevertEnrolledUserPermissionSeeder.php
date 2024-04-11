<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class RevertEnrolledUserPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'enrolled_user',
            'enrolled_user_view',
            'enrolled_user_status',
        ];
        $permissionData = Permission::whereIn('codename', $permissions)->pluck('id');
        foreach ($permissionData as $permission) {
            Permission::find($permission)->delete();
        }
    }
}
