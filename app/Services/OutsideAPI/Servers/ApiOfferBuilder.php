<?php

namespace App\Services\OutsideAPI\Servers;

class ApiOfferBuilder
{
    /** @var int */
    public $id;

    /** @var string */
    public $offer_id;

    /** @var string|null */
    public $country;

    /** @var string|null */
    public $currency;

    /** @var string|null */
    public $advertiser;

    /** @var string|null */
    public $os;

    /** @var string|null */
    public $status;

    protected $offer;

    protected $apiFields = [];

    public function __construct(object $offer, array $fields = [])
    {
        $this->offer = $offer;

        $this->apiFields = $fields;

        $this->id = $this->getOfferField('id');
        $this->offer_id = $this->getOfferField('offer_id');
        $this->country = $this->getOfferField('country');
        $this->currency = $this->getOfferField('currency');
        $this->advertiser = $this->getOfferField('advertiser');
        $this->os = $this->getOfferField('os');
        $this->status = $this->getOfferField('status');
    }

    public function getOffer()
    {
        return $this->offer;
    }

    public function getOfferField(string $field)
    {
        if(array_key_exists($field, $this->apiFields) === false){
            return $this->offer->{$field} ?? null;
        }

        $apiField = $this->apiFields[$field];

        if(strpos($apiField, '.') === false){
            return $this->offer->{$apiField} ?? null;
        }

        $apiFields = explode('.', $apiField);

        $value = null;

        foreach ($apiFields as $fieldItem){
            if(is_null($value)){
                $value = $this->offer->{$fieldItem} ?? '';

                continue;
            }

            if(is_array($value)){
                $value = $value[$fieldItem] ?? '';
            } else{
                $value = $value && $value->{$fieldItem} ? $value->{$fieldItem} : '';
            }

            if($value === ''){
                break;
            }
        }

        return $value;
    }
}