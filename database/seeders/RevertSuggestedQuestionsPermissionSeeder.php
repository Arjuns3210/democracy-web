<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class RevertSuggestedQuestionsPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'suggested_questions',
            'suggested_questions_view',
            'suggested_questions_status'
        ];
        $permissionData = Permission::whereIn('codename', $permissions)->pluck('id');
        foreach ($permissionData as $permission) {
            Permission::find($permission)->delete();
        }
    }
}
