<?php
return [
    'affise' => [
        'handler' => \App\Services\OutsideAPI\Servers\AffiseAPI::class,
        'token' => env('API_AFFISE_TOKEN', null),
        'data' => [
            'offers' => [
                'endpoints' => [
                    'list' => [
                        'url' => 'http://api.gasmobi.affise.com/3.0/offers',
                        'fields' => []
                    ]
                ]
            ]
        ]
    ],
    'pliri' => [
        'handler' => \App\Services\OutsideAPI\Servers\PliriAPI::class,
        'token' => env('API_PLIRI_TOKEN', null),
        'data' => [
            'offers' => [
                'endpoints' => [
                    'list' => [
                        'url' => 'http://demo.api.pliri.net/v1/affiliate-offer/find-all',
                        'fields' => []
                    ]
                ]
            ]
        ]
    ]
];