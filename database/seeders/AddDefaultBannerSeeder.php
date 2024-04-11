<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Banner;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;

class AddDefaultBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::beginTransaction();

            $imagePath = 'backend/img/default-banner.png';
            $fullImagePath = public_path($imagePath);

            $input = [
                'name' => "Default Banner Image",
                'image' => $fullImagePath
            ];

            $data = Banner::create($input);

            if (file_exists($fullImagePath)) {
                $file = UploadedFile::fake()->createWithContent($imagePath, File::get($fullImagePath));
                storeMedia($data, $file, Banner::IMAGE, $data->id);
            } else {
                \Log::error("Banner seeder failed. Default image not found.");
            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Something Went Wrong. Error: " . $e->getMessage());
        }
    }
}
