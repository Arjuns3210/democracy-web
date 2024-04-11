<?php

return [
	'dimensions' => [
		'image' => '200X200 pixel and .jpg, .png, or jpeg format image',
        'banner_width' => '1200',
        'banner_height' => '700',
		'notification_width' => '200',
		'notification_height' => '100',
		'collection_width' => '200',
		'collection_height' => '200',
		'pdf' => 'Only PDF format'
    ],
    'TRIGGER_FPWD_EMAIL' => true,
    //max:1 = max 1024 bytes.
    'MAX_UPLOAD_FILE_SIZE' =>'10240',
    'FCM_SERVER_KEY'=>env('FCM_SERVER_KEY',''),
    'SEND_FCM_NOTIFICATION' => true,
    'NOTIFICATION_ATTEMPT'=>1,
    

    // for frontend
    'contact_no'      => '+91-987-657 3556',
    'email'           => 'info@democracy.com',
    'company_address' => 'Andheri, Mumbai',
    'app_link'        => 'https://google.com',
    'ios_link'        => 'https://google.com',
    'api_url'         => env('API_URL'),
    'uuid'            => '123456789',
    'platform'        => 'web',
    'meta_tags'       => [
        "home"             => [
            "canonical"   => env('BASE_URL'),
            "title"       => "Democracy Quiz App",
            "keywords"    => "Democracy, Politics, Quiz, Knowledge, Voting, Citizens",
            "description" => "Immerse yourself in the world of democracy with our engaging quiz app. Test your knowledge, learn about political systems, and empower yourself as an informed citizen.",
        ],
        "faq"              => [
            "canonical"   => env('BASE_URL').'faq',
            "title"       => "FAQs",
            "keywords"    => "Democracy Quiz App, Questions, Answers, Support, Help",
            "description" => "Find answers to common questions about our Democracy Quiz App. Get support, guidance, and learn how to make the most out of your quiz experience.",
        ],
        "contact"          => [
            "canonical"   => env('BASE_URL').'contact',
            "title"       => "Contact Us",
            "keywords"    => "Democracy Quiz App, Contact, Get in touch, Feedback, Inquiries",
            "description" => "Have questions or feedback about our Democracy Quiz App? Feel free to reach out to us. We value your input and are here to assist you.",
        ],
        "privacy_policy"   => [
            "canonical"   => env('BASE_URL').'privacy',
            "title"       => "Privacy & Policy",
            "keywords"    => "Democracy Quiz App, Privacy, Policy, Data Protection, Confidentiality",
            "description" => "Protecting your privacy is our priority. Learn about our Privacy Policy to understand how we handle your data with care and respect.",
        ],
        "terms_conditions" => [
            "canonical"   => env('BASE_URL').'terms',
            "title"       => "Terms & Conditions",
            "keywords"    => "Democracy Quiz App, Agreement, Rights, Liability, Terms",
            "description" => "Review our Terms & Conditions to understand the guidelines for using our Democracy Quiz App. By accessing the app, you agree to abide by these terms.",
        ],

    ],
];

?>
