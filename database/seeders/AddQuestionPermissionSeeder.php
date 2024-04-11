<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class AddQuestionPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parent_permission = [
            'name' => 'Question',
            'codename' => 'question',
            'parent_status' => 'parent',
            'description' => '',
            'status' => '1'
        ];
        $result = Permission::firstOrCreate($parent_permission);

        $permissions = [
            [
                'name' => 'Add',
                'codename' => 'question_add',
                'parent_status' => $result->id,
                'description' => '',
                'status' => '1'
            ],
            [
                'name' => 'Edit',
                'codename' => 'question_edit',
                'parent_status' => $result->id,
                'description' => '',
                'status' => '1'
            ],
            [
                'name' => 'View',
                'codename' => 'question_view',
                'parent_status' => $result->id,
                'description' => '',
                'status' => '1'
            ],
            [
                'name' => 'Status',
                'codename' => 'question_status',
                'parent_status' => $result->id,
                'description' => '',
                'status' => '1'
            ],
            [
                'name' => 'Delete',
                'codename' => 'question_delete',
                'parent_status' => $result->id,
                'description' => '',
                'status' => '1'
            ]
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate($permission);
        }
    }
}
