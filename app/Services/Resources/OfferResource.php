<?php

namespace App\Services\Resources;

use App\Models\Offer;

class OfferResource
{
    protected $offer;

    public function __construct(Offer $offer)
    {
        $this->offer = $offer;
    }

    public function toResponse()
    {
        $offerAsArray = $this->offer->toArray();

        $offerAsArray['payload'] = json_decode($offerAsArray['payload']);

        return $offerAsArray;
    }
}