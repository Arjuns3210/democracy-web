<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class PrivacyPageController extends Controller
{

    public function fetchPrivacy()
    {

        $api_url = Config::get('global.api_url');
        $uuid = Config::get('global.uuid');
        $platform = Config::get('global.platform');
        
        $response = Http::withBasicAuth('admin', 'mypcot')
            ->withHeaders([
                'UUID' => $uuid,
                'Platform' => $platform
            ])
            ->post($api_url.'/policies', [
                'type' => 'policy'
            ])
            ->json();

        if ($response) {
            $data = $response;
            $privacyContent = $data['data']['result']['content'];
            $tags = config('global.meta_tags')['privacy_policy'];


            return view('frontend.privacy', ['privacyContent' => $privacyContent, 'tags' => $tags]);
        }

        return back()->with('error', 'Failed to fetch privacy policy.');
    }
}

