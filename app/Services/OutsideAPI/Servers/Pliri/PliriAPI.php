<?php

namespace App\Services\OutsideAPI\Servers\Pliri;

use App\Services\OutsideAPI\Servers\Pliri\PliriOfferBuilder;
use App\Services\OutsideAPI\Servers\ServerAPI;
use App\Services\OutsideAPI\Servers\ServerAPIContract;

class PliriAPI extends ServerAPI implements ServerAPIContract
{
    public function __construct()
    {
        $this->config = config('api-servers.pliri');
    }

    public function offersList(): array
    {
        $endpoint = $this->offersListConfig()['url'];

        $this->sendGETRequest($endpoint, [
            'access-token' => $this->config['token']
        ]);

        if($this->responseCode !== 200 || !$this->requestResult->success){
            $this->handleError($this->requestResult->response->message);
        }

        $offers = $this->requestResult->response;

        $offersInfo = [];

        if($offers){
            $offersIDs = collect($offers)->pluck('offer_id')->toArray();

            $platforms = $this->offersPlatform($offersIDs);
            $countries = $this->offersCountries($offersIDs);

            $apiFields = config('api-servers.pliri.data.offers.list.fields');

            foreach ($offers as $offer){
                $offer->os = $platforms[$offer->offer_id] ?? null;
                $offer->country = $countries[$offer->offer_id] ?? null;

                $offersBuilder = new PliriOfferBuilder($offer, $apiFields);

                $offersInfo[] = [
                    'source_id' => 2,
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

    protected function offersPlatform(array $offersIDs)
    {
        $this->sendGETRequest($this->config['data']['offers']['platforms']['url'], [
            'access-token' => $this->config['token'],
            'ids' => $offersIDs
        ]);

        $platformInfo = [];

        if($this->responseCode !== 200 || !$this->requestResult->success){
            $this->handleError($this->requestResult->response->message);
        }

        $offersPlatforms = $this->requestResult->response;

        if(!$offersPlatforms){
            return $platformInfo;
        }

        foreach($offersPlatforms as $offerPlatforms){
            $mobilePlatforms = (array)$offerPlatforms->platform->Mobile ?? [];

            if(!$mobilePlatforms){
               continue;
            }

            $platformsList = array_keys($mobilePlatforms);

            $platformInfo[$offerPlatforms->offer_id] = $platformsList[0];
        }

        return $platformInfo;
    }

    protected function offersCountries(array $offersIDs)
    {
        $this->sendGETRequest($this->config['data']['offers']['countries']['url'], [
            'access-token' => $this->config['token'],
            'ids' => $offersIDs
        ]);

        $countryInfo = [];

        if($this->responseCode !== 200 || !$this->requestResult->success){
            $this->handleError($this->requestResult->response->message);
        }

        $offersCountries = $this->requestResult->response;

        if(!$offersCountries){
            return $countryInfo;
        }

        foreach($offersCountries as $offerCountries){
            $countryInfo[$offerCountries->offer_id] = $offerCountries->targeting[0]
                ? trim(str_replace('(All Cities)', '', $offerCountries->targeting[0]))
                : null;
        }

        return $countryInfo;
    }
}