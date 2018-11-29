<?php
return [
    'affise' => [
        'token' => env('API_AFFISE_TOKEN', null),
        'endpoint' => 'http://api.gasmobi.affise.com/3.0/partner/offers'
    ],
    'pliri' => [
        'token' => env('API_PLIRI_TOKEN', null),
        'endpoint' => 'http://demo.api.pliri.net/v1/affiliate-offer/find-all'
    ]
];