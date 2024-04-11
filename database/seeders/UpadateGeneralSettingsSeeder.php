<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GeneralSetting;

class UpadateGeneralSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GeneralSetting::firstOrCreate(
            [
                'type' => 'yt_link',
            ],
            [
                'value' => 'https://www.youtube.com/@yaduz_fashion_yt',
            ]
        );

        GeneralSetting::where('type', 'fb_link')
            ->orWhere('type', 'twitter_link')
            ->orWhere('type', 'system_email')
            ->orWhere('type', 'system_name')
            ->orWhere('type', 'system_contact_no')
            ->forceDelete();

    }
}
