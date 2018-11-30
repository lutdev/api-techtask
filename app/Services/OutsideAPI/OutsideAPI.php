<?php

namespace App\Services\OutsideAPI;

use App\Exceptions\OutsideAPIException;
use App\Services\Builders\ApiConfigBuilder;
use App\Services\OutsideAPI\Servers\ServerAPIContract;
use DB;

class OutsideAPI
{
    /** @var array */
    protected $config;

    public function __construct()
    {
        $this->config = config('api-servers');
    }

    /**
     * @param $serverName
     *
     * @return array
     * @throws OutsideAPIException
     */
    public function getOffers($serverName): array
    {
        if(array_key_exists($serverName, $this->config) === false){
            throw new OutsideAPIException('API `'.$serverName.'` does not support');
        }

        $apiConfig = new ApiConfigBuilder($this->config[$serverName]);

        return $this->handle($apiConfig);
    }

    protected function handle(ApiConfigBuilder $configBuilder): array
    {
        $handlerClass = $configBuilder->handler;

        /** @var ServerAPIContract $handler */
        $handler = new $handlerClass;

        $offers = $handler->offersList();

        if(!$offers){
            return $this;
        }

        DB::table('offers')->insert($offers);

        return $offers;
    }
}