<?php

namespace Database\Seeders;

use App\Models\GeneralSetting;
use Illuminate\Database\Seeder;

class UpdateGeneralSettingsDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $general_settings_data = [
            "address" => "Andheri(East), Mumbai",
            "latitude" => "19.1179° N",
            "longitude" => "72.8631° E"
        ];

        foreach($general_settings_data as $key => $data){
            GeneralSetting::firstOrCreate([
                "type" => $key,
                "value" => $data
            ]);
        }
    }
}
