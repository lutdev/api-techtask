<?php

namespace App\Services\OutsideAPI\Servers;

use App\Exceptions\OutsideAPIException;

class ServerAPI
{
    /** @var array */
    protected $config;

    protected $requestResult;

    /** @var int */
    protected $responseCode;

    private $endpoint;

    #region Send request
    protected function sendGETRequest(string $endpoint, array $parameters = [])
    {
        $query = $parameters ? http_build_query($parameters) : null;

        $this->endpoint = $query ? $endpoint.'?'.$query : $endpoint;

        return $this->sendRequest($parameters);
    }

    protected function sendRequest(array $parameters = [], bool $isGET = true)
    {
        $curl = curl_init($this->endpoint);

        curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        if($isGET){
            curl_setopt($curl, CURLOPT_HTTPGET, true);
        } else {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $parameters);
        }

        $result = curl_exec($curl);

        $this->responseCode = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);

        curl_close($curl);

        $this->requestResult = json_decode($result);

        return $this;
    }
    #endregion

    /**
     * @param string $errorMessage
     *
     * @throws OutsideAPIException
     */
    protected function handleError(string $errorMessage)
    {
        throw new OutsideAPIException($errorMessage);
    }

    protected function offersListConfig(): array
    {
        return $this->config['data']['offers']['endpoints']['list'];
    }
}