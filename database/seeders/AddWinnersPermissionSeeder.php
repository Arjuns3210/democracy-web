<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class AddWinnersPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parent_permission = [
            'name' => 'Winners',
            'codename' => 'winners',
            'parent_status' => 'parent',
            'description' => '',
            'status' => '1'
        ];
        $result = Permission::firstOrCreate($parent_permission);

        $permissions = [
            [
                'name' => 'View',
                'codename' => 'winners_view',
                'parent_status' => $result->id,
                'description' => '',
                'status' => '1'
            ],
            [
                'name' => 'Status',
                'codename' => 'winners_status',
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
