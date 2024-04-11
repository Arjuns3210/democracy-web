<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;


class FaqPageController extends Controller
{
    /**
     *
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function fetchFaq() {
        $api_url = Config::get('global.api_url');
        $uuid = Config::get('global.uuid');
        $platform = Config::get('global.platform');
        $response = Http::withBasicAuth('admin', 'mypcot')
            ->withHeaders([
                'UUID' => $uuid,
                'Platform' => $platform
            ])
            ->post($api_url . 'faqs/list')
            ->json();

            if($response) {
                $data = $response;
                $faqContent = $data['data']['result'];
                $tags = config('global.meta_tags')['faq'];


                return view('frontend.faq.index', ['faqContent' => $faqContent, 'tags' => $tags]);
            }

        return back()->with('error', 'Failed to fetch Faqs');
    }
}
