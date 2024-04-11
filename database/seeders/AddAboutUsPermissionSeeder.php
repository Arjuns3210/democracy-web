<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class AddAboutUsPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parent_permission = [
            'name' => 'About Us',
            'codename' => 'about_us',
            'parent_status' => 'parent',
            'description' => '',
            'status' => '1'
        ];
        $result = Permission::firstOrCreate($parent_permission);
    }
}
