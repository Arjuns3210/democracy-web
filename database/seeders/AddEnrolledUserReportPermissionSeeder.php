<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class AddEnrolledUserReportPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parent_permission = [
            'name' => 'Enrolled Report',
            'codename' => 'enrolled_report',
            'parent_status' => 'parent',
            'description' => '',
            'status' => '1'
        ];
        $result = Permission::firstOrCreate($parent_permission);
    }
}
