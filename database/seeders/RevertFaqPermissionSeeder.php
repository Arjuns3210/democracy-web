<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class RevertFaqPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'faq',
            'faq_add',
            'faq_edit',
            'faq_view',
            'faq_status',
            'faq_delete'
        ];
        $permissionData = Permission::whereIn('codename', $permissions)->pluck('id');
        foreach ($permissionData as $permission) {
            Permission::find($permission)->delete();
        }
    }
}
