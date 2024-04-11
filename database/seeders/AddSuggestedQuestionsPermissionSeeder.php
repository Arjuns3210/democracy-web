<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class AddSuggestedQuestionsPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parent_permission = [
            'name' => 'Suggested Questions',
            'codename' => 'suggested_questions',
            'parent_status' => 'parent',
            'description' => '',
            'status' => '1'
        ];
        $result = Permission::firstOrCreate($parent_permission);

        $permissions = [
            [
                'name' => 'View',
                'codename' => 'suggested_questions_view',
                'parent_status' => $result->id,
                'description' => '',
                'status' => '1'
            ],
            [
                'name' => 'Status',
                'codename' => 'suggested_questions_status',
                'parent_status' => $result->id,
                'description' => '',
                'status' => '1'
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate($permission);
        }
    }
}
