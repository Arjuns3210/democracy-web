<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class RemoveBannerAddPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissionToDelete = Permission::where('codename', 'banner_add')->first();

        if ($permissionToDelete) {
            $permissionToDelete->delete();
            $this->command->info('Permission "banner_add" deleted successfully.');
        } else {
            $this->command->info('Permission "banner_add" not found.');
        }
    }
}
