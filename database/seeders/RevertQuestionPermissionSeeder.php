<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class RevertQuestionPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'question',
            'question_add',
            'question_edit',
            'question_view',
            'question_status',
            'question_delete'
        ];
        $permissionData = Permission::whereIn('codename', $permissions)->pluck('id');
        foreach ($permissionData as $permission) {
            Permission::find($permission)->delete();
        }
    }
}
