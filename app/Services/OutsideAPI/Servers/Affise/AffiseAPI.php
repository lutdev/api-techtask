<?php

namespace App\Services\OutsideAPI\Servers\Affise;

use App\Services\OutsideAPI\Servers\ApiOfferBuilder;
use App\Services\OutsideAPI\Servers\ServerAPI;
use App\Services\OutsideAPI\Servers\ServerAPIContract;

class AffiseAPI extends ServerAPI  implements ServerAPIContract
{
    public function __construct()
    {
        $this->config = config('api-servers.affise');
    }

    public function offersList(): array
    {
        $endpoint = $this->offersListConfig()['url'];
        $token = $this->config['token'];

        $this->sendGETRequest($endpoint, [
            'api-key' => $token
        ]);

        if($this->responseCode !== 200){
            $this->handleError($this->requestResult->error);
        }

        $offers = $this->requestResult->offers;

        $offersInfo = [];

        if($offers){
            $apiFields = config('api-servers.affise.data.offers.list.fields');

            foreach ($offers as $offer){
                $offersBuilder = new ApiOfferBuilder($offer, $apiFields);
                
                $offersInfo[] = [
                    'source_id' => 1,
                    'offer_id' => $offersBuilder->offer_id,
                    'country'=> $offersBuilder->country,
                    'currency'=> $offersBuilder->currency,
                    'advertiser'=> $offersBuilder->advertiser,
                    'os'=> $offersBuilder->os,
                    'status'=> $offersBuilder->status,
                    'payload'=> json_encode($offersBuilder->getOffer())
                ];
            }
        }

        return $offersInfo;
    }
}