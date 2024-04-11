<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ContactUsRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;


class ContactUsPageController extends Controller
{
    function index()
    {
        $data['tags'] = config('global.meta_tags')['contact'];

        $api_url = Config::get('global.api_url');
        $uuid = Config::get('global.uuid');
        $platform = Config::get('global.platform');
        
        $response = Http::withBasicAuth('admin', 'mypcot')
            ->withHeaders(['UUID' => $uuid, 'Platform' => $platform])
            ->post($api_url . 'contact/show')
            ->json();
        
        $data['contact'] = $response['data']['result'];
        
        return view("frontend/contact/index", $data);
    }

    
    public function storeContactForm(ContactUsRequest $request)
    {
        $validateData = $request->all();

        $body = [
            "name" => $validateData['name'],
            "phone" => $validateData['phone'],
            "message" => $validateData['message']
        ];

        $api_url = Config::get('global.api_url');
        $uuid = Config::get('global.uuid');
        $platform = Config::get('global.platform');
        $response = Http::withBasicAuth('admin', 'mypcot')
            ->withHeaders(['UUID' => $uuid, 'Platform' => $platform])
            ->post($api_url . 'contact/create', $body)
            ->json();

        if ($response) {

            return response()->json(['success' => $response],200);
        }

        return response()->json(['error' => 'Error submitting form.'], 500);

    }
}
