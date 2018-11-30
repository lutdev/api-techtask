<?php

namespace App\Repositories;

use App\Models\Offer;

class OfferRepository
{
    public function findByOfferID($offerID)
    {
        return Offer::where('offer_id', $offerID)->first();
    }

    public function findIDs(array $whereCondition = []): array
    {
        if(!$whereCondition){
            $offers = Offer::all();
        } else{
            $offers = Offer::where($whereCondition)->get();

        }
        return $offers->pluck('offer_id')->toArray();
    }
}