<?php
return [
    'affise' => [
        'handler' => \App\Services\OutsideAPI\Servers\Affise\AffiseAPI::class,
        'token' => env('API_AFFISE_TOKEN', null),
        'data' => [
            'offers' => [
                'list' => [
                    'url' => 'http://api.gasmobi.affise.com/3.0/offers',
                    'fields' => [
                        'offer_id' => 'offer_id',
                        'country' => 'countries.0',
                        'currency' => 'payments.0.currency',
                        'advertiser' => '',
                        'os' => 'payments.0.os.0',
                        'status' => ''
                    ]
                ]
            ]
        ]
    ],
    'pliri' => [
        'handler' => \App\Services\OutsideAPI\Servers\Pliri\PliriAPI::class,
        'token' => env('API_PLIRI_TOKEN', null),
        'data' => [
            'offers' => [
                'list' => [
                    'url' => 'http://demo.api.pliri.net/v1/affiliate-offer/find-all',
                    'fields' => [
                        'offer_id' => 'offer_id',
                        'status' => 'status',
                        'os' => 'os',
                        'country' => 'country',
                        'currency' => '',
                        'advertiser' => '',
                    ]
                ],
                'platforms' => [
                    'url' => 'http://demo.api.pliri.net/v1/affiliate-offer/get-platform'
                ],
                'countries' => [
                    'url' => 'http://demo.api.pliri.net/v1/affiliate-offer/get-targeting'
                ]
            ]
        ]
    ]
];