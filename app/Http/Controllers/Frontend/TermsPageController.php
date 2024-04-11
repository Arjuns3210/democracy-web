<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class TermsPageController extends Controller
{
    
    public function fetchTerms()
    {
        $api_url = Config::get('global.api_url');
        $uuid = Config::get('global.uuid');
        $platform = Config::get('global.platform');
        
        $response = Http::withBasicAuth('admin', 'mypcot')
            ->withHeaders([
                'UUID' => $uuid,
                'Platform' => $platform
            ])
            ->post( $api_url . 'policies', [
                'type' => 'terms'
            ])
            ->json();
        if ($response) {
            $data = $response;
            $termsContent = $data['data']['result']['content'];
            $tags = config('global.meta_tags')['terms_conditions'];

            return view('frontend.terms', ['termsContent' => $termsContent, 'tags' => $tags]);
        }

        return back()->with('error', 'Failed to fetch terms and conditions.');
    }
}

